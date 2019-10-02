<?php

namespace Sven\ForgeCLI\Tests\Commands;

use Sven\ForgeCLI\Commands\Certificates\Activate;
use Sven\ForgeCLI\Tests\TestCase;
use Themsaid\Forge\Resources\Certificate;

class CertificatesTest extends TestCase
{
    /** @test */
    public function it_can_activate_a_certificate()
    {
        $this->forge->shouldReceive()
            ->activateCertificate('12345', '67890', '13579', false)
            ->once()
            ->andReturn([
                new Certificate(['id' => '13579', 'serverId' => '12345', 'siteId' => '67890']),
            ]);

        $tester = $this->command(Activate::class);

        $tester->execute([
            'server' => '12345',
            'site' => '67890',
            'certificate' => '13579',
        ]);
    }

    /** @test */
    public function it_can_wait_for_activation_of_a_certificate()
    {
        $this->forge->shouldReceive()
            ->activateCertificate('12345', '67890', '13579', true)
            ->once();

        $tester = $this->command(Activate::class);

        $tester->execute([
            'server' => '12345',
            'site' => '67890',
            'certificate' => '13579',
            '--wait' => '',
        ]);
    }
}
