<?php

namespace Tests\Feature;

use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Orangtua;
use App\Models\Pengajaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AcademicManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_pengajaran_can_be_created_updated_and_deleted(): void
    {
        $guru = $this->createGuru();
        $mapel = $this->createMapel();
        $kelas = $this->createKelas($guru);

        $this->get(route('pengajaran.index'))->assertOk();
        $this->get(route('pengajaran.create'))->assertOk();

        $this->from(route('pengajaran.create'))
            ->post(route('pengajaran.store'), [
                'id_guru' => $guru->id_guru,
                'id_mapel' => $mapel->id_mapel,
                'id_kelas' => $kelas->id_kelas,
                'hari' => 'Minggu',
                'jam' => '07:00 - 08:30',
            ])
            ->assertSessionHasErrors('hari');

        $this->assertDatabaseCount('pengajarans', 0);

        $this->post(route('pengajaran.store'), [
            'id_guru' => $guru->id_guru,
            'id_mapel' => $mapel->id_mapel,
            'id_kelas' => $kelas->id_kelas,
            'hari' => 'Senin',
            'jam' => '07:00 - 08:30',
        ])->assertRedirect(route('pengajaran.index'));

        $jadwal = Pengajaran::query()->firstOrFail();
        $this->assertDatabaseHas('pengajarans', [
            'id_pengajaran' => $jadwal->id_pengajaran,
            'hari' => 'Senin',
        ]);
        $this->get(route('pengajaran.index'))
            ->assertOk()
            ->assertSee('Guru Contoh')
            ->assertSee('Matematika');

        $this->get(route('pengajaran.edit', $jadwal))->assertOk();
        $this->put(route('pengajaran.update', $jadwal), [
            'id_guru' => $guru->id_guru,
            'id_mapel' => $mapel->id_mapel,
            'id_kelas' => $kelas->id_kelas,
            'hari' => 'Selasa',
            'jam' => '08:30 - 10:00',
        ])->assertRedirect(route('pengajaran.index'));

        $this->assertDatabaseHas('pengajarans', [
            'id_pengajaran' => $jadwal->id_pengajaran,
            'hari' => 'Selasa',
            'jam' => '08:30 - 10:00',
        ]);

        $this->delete(route('pengajaran.destroy', $jadwal))
            ->assertRedirect(route('pengajaran.index'));

        $this->assertDatabaseMissing('pengajarans', ['id_pengajaran' => $jadwal->id_pengajaran]);
    }

    public function test_nilai_can_be_created_updated_and_deleted_and_duplicate_records_are_rejected(): void
    {
        $siswa = $this->createSiswa();
        $mapel = $this->createMapel();
        $tahunAjaran = TahunAjaran::create([
            'tahun_ajaran' => '2026/2027',
            'semester' => 'Ganjil',
            'status' => 'Aktif',
        ]);

        $this->get(route('nilai.index'))->assertOk();
        $this->get(route('nilai.create'))->assertOk();

        $dataNilai = [
            'id_siswa' => $siswa->id_siswa,
            'id_mapel' => $mapel->id_mapel,
            'id_tahunajaran' => $tahunAjaran->id_tahunajaran,
            'nilai_pengetahuan' => 88.5,
            'nilai_keterampilan' => 91,
            'nilai_akhir' => 90,
            'predikat' => 'A',
        ];

        $this->from(route('nilai.create'))
            ->post(route('nilai.store'), [...$dataNilai, 'nilai_akhir' => 101])
            ->assertSessionHasErrors('nilai_akhir');

        $this->assertDatabaseCount('nilais', 0);

        $this->post(route('nilai.store'), $dataNilai)
            ->assertRedirect(route('nilai.index'));

        $nilai = Nilai::query()->firstOrFail();
        $this->assertDatabaseHas('nilais', [
            'id_nilai' => $nilai->id_nilai,
            'nilai_akhir' => 90,
            'predikat' => 'A',
        ]);
        $this->get(route('nilai.index'))
            ->assertOk()
            ->assertSee('Siswa Contoh')
            ->assertSee('Matematika');

        $this->get(route('nilai.edit', $nilai))->assertOk();
        $this->put(route('nilai.update', $nilai), [...$dataNilai, 'nilai_akhir' => 92])
            ->assertRedirect(route('nilai.index'));

        $this->assertDatabaseHas('nilais', [
            'id_nilai' => $nilai->id_nilai,
            'nilai_akhir' => 92,
        ]);

        $this->from(route('nilai.create'))
            ->post(route('nilai.store'), $dataNilai)
            ->assertSessionHasErrors('id_siswa');

        $this->assertDatabaseCount('nilais', 1);

        $this->delete(route('nilai.destroy', $nilai))
            ->assertRedirect(route('nilai.index'));

        $this->assertDatabaseMissing('nilais', ['id_nilai' => $nilai->id_nilai]);
    }

    private function createGuru(): Guru
    {
        return Guru::create([
            'nama' => 'Guru Contoh',
            'nip' => '123456789',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1980-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'alamat' => 'Jalan Sekolah',
            'no_telp' => '081234567890',
        ]);
    }

    private function createMapel(): MataPelajaran
    {
        return MataPelajaran::create([
            'kode_mapel' => 'MTK-01',
            'nama_mapel' => 'Matematika',
            'kelompok' => 'Umum',
        ]);
    }

    private function createKelas(Guru $guru): Kelas
    {
        $jurusan = Jurusan::create([
            'kode_jurusan' => 'RPL',
            'nama' => 'Rekayasa Perangkat Lunak',
            'id_kepalajurusan' => $guru->id_guru,
        ]);

        return Kelas::create([
            'nama_kelas' => 'X-RPL-1',
            'tingkat' => 'X',
            'tahun_ajaran' => '2026/27',
            'id_jurusan' => $jurusan->id_jurusan,
            'id_walikelas' => $guru->id_guru,
        ]);
    }

    private function createSiswa(): Siswa
    {
        $orangtua = Orangtua::create([
            'nama' => 'Orangtua Contoh',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1975-01-01',
            'no_telp' => '081234567891',
        ]);

        return Siswa::create([
            'nama' => 'Siswa Contoh',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2008-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'alamat' => 'Jalan Siswa',
            'no_telp' => '081234567892',
            'id_orangtua' => $orangtua->id_orangtua,
        ]);
    }
}
