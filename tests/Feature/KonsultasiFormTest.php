<?php

declare(strict_types=1);

use App\Livewire\KonsultasiForm;
use Livewire\Livewire;

describe('Konsultasi Form - Modal Konfirmasi', function () {
    it('component dapat di-load', function () {
        $component = Livewire::test(KonsultasiForm::class);

        expect($component)->toBeTruthy();
    });

    it('form menampilkan elemen yang dibutuhkan', function () {
        Livewire::test(KonsultasiForm::class)
            ->assertSee('Formulir Konsultasi')
            ->assertSee('Nama')
            ->assertSee('No. WhatsApp')
            ->assertSee('Jenis Konsultasi')
            ->assertSee('Hubungi Kami');
    });

    it('showModalKonfirmasi property dimulai dengan false', function () {
        Livewire::test(KonsultasiForm::class)
            ->assertSet('showModalKonfirmasi', false);
    });

    it('dataKonfirmasi property dimulai dengan null', function () {
        Livewire::test(KonsultasiForm::class)
            ->assertSet('dataKonfirmasi', null);
    });

    it('tutupModalKonfirmasi method menutup modal', function () {
        Livewire::test(KonsultasiForm::class)
            ->set('showModalKonfirmasi', true)
            ->set('dataKonfirmasi', ['test' => 'data'])
            ->call('tutupModalKonfirmasi')
            ->assertSet('showModalKonfirmasi', false)
            ->assertSet('dataKonfirmasi', null);
    });
});
