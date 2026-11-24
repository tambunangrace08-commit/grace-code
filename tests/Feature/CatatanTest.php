<?php

namespace Tests\Feature;

use App\Models\Catatan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatatanTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_note_can_be_created(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->post(route('catatan.store'), [
            'judul' => 'Catatan baru',
            'isi' => 'Isi catatan baru',
        ]);

        $response->assertRedirect(route('catatan.index'));
        $this->assertDatabaseHas('catatan', [
            'judul' => 'Catatan baru',
            'isi' => 'Isi catatan baru',
        ]);
    }

    public function test_a_note_can_be_edited(): void
    {
        $this->actingAs(User::factory()->create());
        $catatan = Catatan::create(['judul' => 'Judul lama', 'isi' => 'Isi lama']);

        $this->get(route('catatan.edit', $catatan))
            ->assertOk()
            ->assertSee('Judul lama');

        $response = $this->put(route('catatan.update', $catatan), [
            'judul' => 'Judul baru',
            'isi' => 'Isi baru',
        ]);

        $response->assertRedirect(route('catatan.index'));
        $this->assertDatabaseHas('catatan', [
            'id' => $catatan->id,
            'judul' => 'Judul baru',
            'isi' => 'Isi baru',
        ]);
    }

    public function test_a_note_can_be_deleted(): void
    {
        $this->actingAs(User::factory()->create());
        $catatan = Catatan::create(['judul' => 'Catatan yang dihapus', 'isi' => 'Isi catatan']);

        $response = $this->delete(route('catatan.destroy', $catatan));

        $response->assertRedirect(route('catatan.index'));
        $this->assertDatabaseMissing('catatan', ['id' => $catatan->id]);
    }

    public function test_a_note_can_be_viewed_and_note_actions_are_available(): void
    {
        $this->actingAs(User::factory()->create());
        $catatan = Catatan::create(['judul' => 'Catatan detail', 'isi' => 'Isi lengkap']);

        $this->get(route('catatan.index'))
            ->assertOk()
            ->assertSee(route('catatan.show', $catatan))
            ->assertSee(route('catatan.edit', $catatan))
            ->assertSee(route('catatan.destroy', $catatan));

        $this->get(route('catatan.show', $catatan))
            ->assertOk()
            ->assertSee('Isi lengkap');
    }

    public function test_note_pages_require_login(): void
    {
        $this->get(route('catatan.index'))
            ->assertRedirect(route('login'));
    }
}
