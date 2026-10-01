<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

/**
 * Replace every real teacher/student identity in the database with made up data.
 *
 * The school site is deployed publicly (Vercel) as a showcase, but the TiDB database
 * holds genuine data: real teacher and student names, their NIY/NISN codes, the
 * uploaded photo paths (which embed both the code and the name) and the password
 * hashes of the real accounts.
 *
 * This command rewrites all of that:
 *
 *   gurus.id_guru, gurus.niy, gurus.nama_guru, gurus.file_guru
 *   siswas.nisn, siswas.nama_siswa, siswas.file_siswa
 *   users.username, users.name, users.password, users.remember_token
 *   mapels.id_guru                      (holds a guru code, so it has to follow)
 *
 * Plus the transient tables that leak personal data around (cache keys hold e-mail
 * addresses, session rows hold previous logins).
 *
 * Deliberately NOT touched: jabatan (Kepala Sekolah / GTY / GTT / ...) because
 * resources/views/guru.blade.php matches those exact strings to build the public page,
 * and every table without personal data in it (beritas, pengumumans, galeris, ...).
 */
class AnonymizeData extends Command
{
    protected $signature = 'db:anonymize
        {--dry-run : Report what would change without writing anything}
        {--sql= : Write the generated SQL to this file instead of executing it}
        {--keep-file-paths : Leave the file_guru / file_siswa columns untouched}
        {--password=password : Plain text password assigned to every account}
        {--seed=zahra : Seed for the deterministic fake data}
        {--force : Skip the confirmation prompt / the already-anonymized guard}';

    protected $description = 'Replace real teacher/student identities (names, NIY/NISN codes, photo paths, passwords) with dummy data';

    /** Fake guru codes: 11 digits, same width as the real NIY values (varchar(11)). */
    private const GURU_PREFIX = '8';

    /** Fake student codes: 10 digits, same width as the real NISN values (varchar(10)). */
    private const SISWA_PREFIX = '8';


    /** Made up name parts, so the fake identities still read like Indonesian names. */
    private const FIRST_MALE = ['Ahmad', 'Bagas', 'Bayu', 'Budi', 'Dimas', 'Eko', 'Fajar', 'Farhan', 'Galih', 'Hendra', 'Ilham', 'Irfan', 'Joko', 'Lukman', 'Nanda', 'Rangga', 'Rendi', 'Rizky', 'Satria', 'Taufik', 'Wahyu', 'Yoga', 'Zaki', 'Arif', 'Dedi', 'Rizal', 'Yusuf', 'Sandi'];
    private const FIRST_FEMALE = ['Aisyah', 'Anisa', 'Ayu', 'Bella', 'Citra', 'Dewi', 'Dinda', 'Fitri', 'Hana', 'Indah', 'Intan', 'Kiara', 'Laras', 'Maya', 'Melati', 'Nabila', 'Nadia', 'Putri', 'Rahma', 'Ratna', 'Salma', 'Sari', 'Sinta', 'Tiara', 'Wulan', 'Yuni', 'Zahra', 'Lestari', 'Alya', 'Nurul'];
    private const MIDDLE_MALE = ['Adi', 'Arif', 'Bima', 'Cahyo', 'Dwi', 'Fahri', 'Gunawan', 'Hidayat', 'Iqbal', 'Kurnia', 'Nugroho', 'Permana', 'Pratama', 'Putra', 'Ramadhan', 'Santoso', 'Saputra', 'Setiawan', 'Firmansyah', 'Hakim'];
    private const MIDDLE_FEMALE = ['Anggraini', 'Fitriani', 'Kartika', 'Lestari', 'Maharani', 'Oktaviani', 'Puspita', 'Rahmawati', 'Safitri', 'Sulistyowati', 'Utami', 'Wahyuni', 'Wulandari', 'Yuliana', 'Amelia', 'Handayani', 'Kusuma', 'Ramadhani', 'Safira', 'Purnama'];
    private const LAST = ['Pratama', 'Saputra', 'Wijaya', 'Santoso', 'Hidayat', 'Nugroho', 'Kurniawan', 'Setiawan', 'Ramadhan', 'Firmansyah', 'Permana', 'Wibowo', 'Gunawan', 'Hakim', 'Putra', 'Utama', 'Susanto', 'Maulana', 'Rahmawan', 'Hartono', 'Suryana', 'Wardana', 'Prasetya', 'Firdaus', 'Syahputra', 'Anggara', 'Budiman', 'Cahyono', 'Siregar', 'Simanjuntak'];
    private const DEGREES = ['S. Pd.', 'S. Kom.', 'M. Pd.', 'A. Md.', 'S. Sos. I.', 'S.E.', 'S. Ag.', 'S. Si.', 'S. T.'];

    /** Jabatan values that are not academic, so no degree suffix is added. */
    private const NON_ACADEMIC = ['Satuan Pengaman', 'Petugas Kebersihan'];

    private string $seed = 'zahra';

    public function handle(): int
    {
        $this->seed = (string) $this->option('seed');
        $sqlTarget = $this->option('sql');
        $dryRun = (bool) $this->option('dry-run');

        foreach (['gurus', 'siswas', 'users'] as $required) {
            if (! Schema::hasTable($required)) {
                $this->error("Table '{$required}' does not exist on connection '".config('database.default')."'. Nothing to do.");

                return self::FAILURE;
            }
        }

        $gurus = DB::table('gurus')->orderBy('id_guru')->get();
        $siswas = DB::table('siswas')->orderBy('nisn')->get();
        $users = DB::table('users')->orderBy('id')->get();

        if ($gurus->isEmpty() && $siswas->isEmpty() && $users->isEmpty()) {
            $this->error('No rows to anonymize.');

            return self::FAILURE;
        }

        $plan = $this->buildPlan($gurus, $siswas, $users);
        $statements = $plan['statements'];

        $this->table(
            ['Table', 'Rows', 'Example change'],
            [
                ['gurus', $gurus->count(), $plan['preview']['guru']],
                ['siswas', $siswas->count(), $plan['preview']['siswa']],
                ['users', $users->count(), $plan['preview']['user']],
            ]
        );

        if ($this->looksAnonymized($gurus, $siswas) && ! $this->option('force')) {
            $this->warn('This database already looks anonymized (all guru/siswa codes use the generated prefix).');
            $this->line('Re-run with --force to regenerate everything anyway.');

            return self::SUCCESS;
        }

        if ($sqlTarget) {
            $this->writeSqlFile((string) $sqlTarget, $statements);
            $this->info(count($statements).' statements written to '.$sqlTarget);

            return self::SUCCESS;
        }

        if ($dryRun) {
            $this->newLine();
            $this->line('<comment>--dry-run</comment>: nothing was written. First statements:');
            foreach (array_slice($statements, 0, 6) as $statement) {
                $this->line('  '.$this->interpolate($statement));
            }
            $this->line('  ... '.count($statements).' statements in total');

            return self::SUCCESS;
        }

        if (! $this->option('force') && ! $this->confirm('Rewrite every teacher/student identity on connection "'.config('database.default').'" with fake data?', false)) {
            $this->warn('Aborted, nothing was written.');

            return self::SUCCESS;
        }

        return $this->apply($statements, $plan['password']);
    }

    /**
     * Build every fake identity plus the statements that install them.
     *
     * @return array{statements: array<int, array{sql: string, bindings: array}>, preview: array<string, string|null>, password: string}
     */
    private function buildPlan($gurus, $siswas, $users): array
    {
        $keepPaths = (bool) $this->option('keep-file-paths');

        // Every code that already exists anywhere in the two identity tables. New
        // codes are drawn from outside this set, which is what makes the renames
        // collision free (a new code can never clash with a code not yet migrated).
        $taken = [];
        foreach ($gurus as $guru) {
            $taken[(string) $guru->id_guru] = true;
        }
        foreach ($siswas as $siswa) {
            $taken[(string) $siswa->nisn] = true;
        }

        $guruIdMap = $this->codeMap($gurus, 'id_guru', self::GURU_PREFIX, 11, $taken);
        $siswaIdMap = $this->codeMap($siswas, 'nisn', self::SISWA_PREFIX, 10, $taken);

        $guruNameMap = [];
        $guruFileMap = [];
        foreach (array_values($gurus->all()) as $index => $guru) {
            $id = (string) $guru->id_guru;
            $academic = ! in_array($guru->jabatan, self::NON_ACADEMIC, true);

            $guruNameMap[$id] = $this->fakeName('guru|'.$id, $this->hasDegree($guru->nama_guru), $academic);
            $guruFileMap[$id] = $keepPaths
                ? $guru->file_guru
                : $this->fakePath('gurus', $guru->file_guru, $guruIdMap[$id], 'guru', $index + 1);
        }

        $siswaNameMap = [];
        $siswaFileMap = [];
        foreach (array_values($siswas->all()) as $index => $siswa) {
            $id = (string) $siswa->nisn;

            $siswaNameMap[$id] = $this->fakeName('siswa|'.$id, false, false);
            $siswaFileMap[$id] = $keepPaths
                ? $siswa->file_siswa
                : $this->fakePath('siswas', $siswa->file_siswa, $siswaIdMap[$id], 'siswa', $index + 1);
        }

        $statements = [];

        foreach ($gurus as $guru) {
            $id = (string) $guru->id_guru;

            $set = [
                'id_guru' => $guruIdMap[$id],
                'nama_guru' => $guruNameMap[$id],
                // A real NIY is a code and must go; the literal '-' markers stay.
                'niy' => preg_match('/^\d+$/', (string) $guru->niy) ? $guruIdMap[$id] : $guru->niy,
            ];

            if (! $keepPaths) {
                $set['file_guru'] = $guruFileMap[$id];
            }

            $statements[] = $this->updateStatement('gurus', ['id_guru' => $id], $set);
        }

        foreach ($siswas as $siswa) {
            $id = (string) $siswa->nisn;

            $set = [
                'nisn' => $siswaIdMap[$id],
                'nama_siswa' => $siswaNameMap[$id],
            ];

            if (! $keepPaths) {
                $set['file_siswa'] = $siswaFileMap[$id];
            }

            $statements[] = $this->updateStatement('siswas', ['nisn' => $id], $set);
        }

        // mapels.id_guru stores a guru code, so it has to follow the rename.
        if (Schema::hasTable('mapels')) {
            foreach ($guruIdMap as $old => $new) {
                $statements[] = $this->updateStatement('mapels', ['id_guru' => $old], ['id_guru' => $new]);
            }
        }

        // users.username mirrors gurus.id_guru / siswas.nisn (that is how the app logs
        // people in) so it moves with them; users.name follows the renamed identity.
        $orphans = 0;
        foreach ($users as $user) {
            $key = (string) $user->username;

            if (isset($guruIdMap[$key])) {
                $newUsername = $guruIdMap[$key];
                $newName = $guruNameMap[$key];
            } elseif (isset($siswaIdMap[$key])) {
                $newUsername = $siswaIdMap[$key];
                $newName = $siswaNameMap[$key];
            } else {
                // Defensive: an account with no matching guru/siswa row still gets a
                // fresh code and name, so no real identity can survive in users.
                $orphans++;
                $newUsername = $this->freeCode('7', 10, $taken);
                $newName = $this->fakeName('user|'.$orphans, false, false);
            }

            $statements[] = $this->updateStatement('users', ['username' => $key], [
                'username' => $newUsername,
                'name' => $newName,
            ]);
        }

        // Real password hashes + remember tokens that would keep live browser
        // sessions authenticated.
        $password = (string) $this->option('password');
        $statements[] = [
            'sql' => 'UPDATE '.$this->quoteIdentifier('users').' SET '
                .$this->quoteIdentifier('password').' = ?, '
                .$this->quoteIdentifier('remember_token').' = NULL',
            'bindings' => [Hash::make($password)],
        ];

        // Transient tables that carry personal data around.
        foreach (['cache', 'cache_locks', 'sessions'] as $temporary) {
            if (Schema::hasTable($temporary)) {
                $statements[] = ['sql' => 'DELETE FROM '.$this->quoteIdentifier($temporary), 'bindings' => []];
            }
        }

        return [
            'statements' => $statements,
            'password' => $password,
            'preview' => [
                'guru' => $this->preview($gurus, 'id_guru', 'nama_guru', $guruIdMap, $guruNameMap),
                'siswa' => $this->preview($siswas, 'nisn', 'nama_siswa', $siswaIdMap, $siswaNameMap),
                'user' => $this->preview($users, 'username', 'name', $guruIdMap + $siswaIdMap, $guruNameMap + $siswaNameMap),
            ],
        ];
    }


    /**
     * Deterministic, collision free renaming of a code column.
     *
     * @param  iterable  $rows  rows holding the real codes
     * @param  array<string, bool>  $taken  every code already in use (passed by reference, new codes are added)
     * @return array<string, string> old code => new code
     */
    private function codeMap($rows, string $column, string $prefix, int $width, array &$taken): array
    {
        $map = [];
        $counter = 1;

        foreach ($rows as $row) {
            $old = (string) $row->{$column};

            do {
                $candidate = $prefix.str_pad((string) $counter, $width - 1, '0', STR_PAD_LEFT);
                $counter++;
            } while (isset($taken[$candidate]));

            if (strlen($candidate) !== $width) {
                throw new \RuntimeException("Generated code '{$candidate}' does not fit the {$width} character column.");
            }

            $taken[$candidate] = true;
            $map[$old] = $candidate;
        }

        return $map;
    }

    /** A code from a private range, used for accounts with no guru/siswa row. */
    private function freeCode(string $prefix, int $width, array &$taken): string
    {
        $counter = 1;

        do {
            $candidate = $prefix.str_pad((string) $counter, $width - 1, '0', STR_PAD_LEFT);
            $counter++;
        } while (isset($taken[$candidate]));

        $taken[$candidate] = true;

        return $candidate;
    }

    /**
     * Fake name, stable for a given seed + key so re-runs (with --force) and the
     * generated SQL file always agree.
     */
    private function fakeName(string $key, bool $withDegree, bool $academic): string
    {
        $female = $this->hash($key.'|gender') % 2 === 0;

        $name = $this->fromList($female ? self::FIRST_FEMALE : self::FIRST_MALE, $key.'|first')
            .' '.$this->fromList($female ? self::MIDDLE_FEMALE : self::MIDDLE_MALE, $key.'|middle')
            .' '.$this->fromList(self::LAST, $key.'|last');

        if ($withDegree && $academic) {
            $name .= ', '.$this->fromList(self::DEGREES, $key.'|degree');
        }

        return $name;
    }

    private function fromList(array $list, string $key): string
    {
        return $list[$this->hash($key) % count($list)];
    }

    private function hash(string $key): int
    {
        return (int) hexdec(substr(md5($this->seed.'|'.$key), 0, 8));
    }

    /** Real names carry a degree suffix ("..., S. Pd."); the fake one keeps the style. */
    private function hasDegree(?string $name): bool
    {
        return (bool) preg_match('/,\s*[A-Za-z]/', (string) $name);
    }

    /**
     * Photo paths embed the identity twice: the folder is the person's code and the
     * file name is often the person's name ("gurus/19750607070/kemas.jpg").
     */
    private function fakePath(string $folder, $originalPath, string $newCode, string $prefix, int $index): ?string
    {
        $original = trim((string) $originalPath);

        if ($original === '') {
            return $originalPath;
        }

        // A few legacy rows were stored with a literal "\r\n" glued to the file name
        // (MySQL turns those into a real CR/LF, other engines keep the two characters),
        // so strip both shapes before reading the extension.
        $original = trim(preg_replace('/(?:\\\\r|\\\\n|\\\\t)+$/', '', $original));
        $extension = strtolower(pathinfo($original, PATHINFO_EXTENSION));

        if (! preg_match('/^[a-z0-9]{1,5}$/', $extension)) {
            $extension = '';
        }

        return $folder.'/'.$newCode.'/'.$prefix.'-'.$index.($extension !== '' ? '.'.$extension : '');
    }

    /** Rows whose codes already use the generated prefix were handled by a previous run. */
    private function looksAnonymized($gurus, $siswas): bool
    {
        return $this->allSharePrefix($gurus, 'id_guru', self::GURU_PREFIX, 11)
            && $this->allSharePrefix($siswas, 'nisn', self::SISWA_PREFIX, 10);
    }

    private function allSharePrefix($rows, string $column, string $prefix, int $width): bool
    {
        $codes = array_map(fn ($row) => (string) $row->{$column}, $rows->all());

        if ($codes === []) {
            return true;
        }

        $matching = array_filter($codes, fn ($code) => (bool) preg_match('/^'.preg_quote($prefix, '/').'\d{'.($width - 1).'}$/', $code));

        return count($matching) === count($codes);
    }

    private function preview($rows, string $codeColumn, string $nameColumn, array $codeMap, array $nameMap): ?string
    {
        $first = $rows->first();

        if (! $first) {
            return null;
        }

        $old = (string) $first->{$codeColumn};

        return $old.' ('.$first->{$nameColumn}.') -> '.($codeMap[$old] ?? '-').' ('.($nameMap[$old] ?? 'new name').')';
    }

    private function updateStatement(string $table, array $where, array $set): array
    {
        $bindings = [];
        $setParts = [];
        $whereParts = [];

        foreach ($set as $column => $value) {
            $setParts[] = $this->quoteIdentifier($column).' = ?';
            $bindings[] = $value;
        }

        foreach ($where as $column => $value) {
            $whereParts[] = $this->quoteIdentifier($column).' = ?';
            $bindings[] = $value;
        }

        return [
            'sql' => 'UPDATE '.$this->quoteIdentifier($table).' SET '.implode(', ', $setParts)
                .' WHERE '.implode(' AND ', $whereParts),
            'bindings' => $bindings,
        ];
    }

    private function apply(array $statements, string $password): int
    {
        $connection = config('database.default');

        DB::beginTransaction();

        try {
            foreach ($statements as $statement) {
                DB::statement($statement['sql'], $statement['bindings']);
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error('Rolled back, nothing changed: '.$e->getMessage());

            return self::FAILURE;
        }

        $this->info(count($statements).' statements applied on connection "'.$connection.'".');
        $this->line('Every account now uses the password: <comment>'.$password.'</comment>');
        $this->newLine();
        $this->table(
            ['Identity', 'New code shape', 'Example'],
            [
                ['guru / admin accounts', '11 digits', $this->exampleCode(self::GURU_PREFIX, 11, 1)],
                ['siswa accounts', '10 digits', $this->exampleCode(self::SISWA_PREFIX, 10, 1)],
            ]
        );

        return self::SUCCESS;
    }

    private function writeSqlFile(string $path, array $statements): void
    {
        $lines = [
            '-- Generated by: php artisan db:anonymize --sql='.$path,
            '-- Replaces every real teacher/student identity (names, NIY/NISN codes, photo',
            '-- paths, password hashes) with dummy data. Review, then run it on TiDB.',
            '',
            'START TRANSACTION;',
            '',
        ];

        foreach ($statements as $statement) {
            $lines[] = $this->interpolate($statement).';';
        }

        $lines[] = '';
        $lines[] = 'COMMIT;';
        $lines[] = '';

        // "\n" rather than PHP_EOL: the file is pasted into a web SQL console, CRLF would
        // just be noise, and it keeps the file identical on every platform.
        file_put_contents($path, implode("\n", $lines));
    }

    /** Render a prepared statement with its bindings inlined, for the SQL file. */
    private function interpolate(array $statement): string
    {
        $sql = $statement['sql'];
        $offset = 0;

        foreach ($statement['bindings'] as $binding) {
            $replacement = $binding === null ? 'NULL' : $this->quoteLiteral((string) $binding);
            $position = strpos($sql, '?', $offset);

            if ($position === false) {
                break;
            }

            $sql = substr($sql, 0, $position).$replacement.substr($sql, $position + 1);
            $offset = $position + strlen($replacement);
        }

        return $sql;
    }

    private function quoteIdentifier(string $name): string
    {
        return '`'.str_replace('`', '``', $name).'`';
    }

    private function exampleCode(string $prefix, int $width, int $counter): string
    {
        return $prefix.str_pad((string) $counter, $width - 1, '0', STR_PAD_LEFT);
    }

    private function quoteLiteral(string $value): string
    {
        return "'".str_replace(['\\', "'"], ['\\\\', "''"], $value)."'";
    }
}

