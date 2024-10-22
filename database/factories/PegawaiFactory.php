<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gb = ['S.pd', 'M.Kom', 'S.Ag', 'Ph.d','S.E'];
        $g = ['l','p'];
        $gd= ['A', 'B' ,'AB' ,'O', 'Tidak Tahu'];
        $gd= ['Dr', 'Ir', 'Prof', 'KH'];
        $ag= ['Islam', 'Kristen', 'Hindu', 'Budha', 'Konghucu'];
        return [
            'nip' =>fake()->randomNumber(),
            'nama' => fake()->name(),
            'gelar_depan' =>fake()->randomElement($gd),
            'gelar_belakang' =>fake()->randomElement($gb),
            'tempat_lahir' =>fake()->city(),
            'tanggal_lahir' =>fake()->date(),
            'gender' => fake()->randomElement($g),
            'agama' => fake()->randomElement($ag),
            'gol_darah' =>fake()->randomElement($gd),
            'status_pernikahan' =>fake()->word(),
            'nik' =>fake()->nik(),
            'telp' =>fake()->phoneNumber(),
            'email' =>fake()->unique()->safeEmail(),
            'alamat' =>fake()->address(),
            'npwp' =>fake()->randomNumber(),
            'bpjs' =>fake()->randomNumber(),
            'karpeg' =>fake()->randomNumber(),
            'status_kepegawaian' =>fake()->word(),
            'no_sk_cpns' =>fake()->randomNumber(),
            'tmt_sk_cpns' =>fake()->date(),
            'no_sk_pns' =>fake()->randomNumber(),
            'tmt_sk_pns' =>fake()->date(),
            'tpp' =>fake()->randomNumber(),

        ];
    }
}
