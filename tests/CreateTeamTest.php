<?php declare(strict_types=1);

namespace App\Tests;

use App\ResourceAlreadyExistsException;
use App\Service\CreateTeam;
use App\Tests\FootballApiTest;

class CreateTeamTest extends FootballApiTest
{
    public function testCreatesTeam(): void
    {
        $createTeam = new CreateTeam($this->leagueRepository, $this->teamRepository, $this->objectManager);

        $team = $createTeam(
            $this->league->getId(),
            $this->team->getId(),
            $this->team->getName(),
            $this->team->getStrip()
        );

        self::assertEquals($this->team, $team);
    }

    public function testThrowsExceptionIfTeamAlreadyExists(): void
    {
        $this->teamRepository
            ->method('find')
            ->with($this->team->getId())
            ->willReturn($this->team);

        $createTeam = new CreateTeam($this->leagueRepository, $this->teamRepository, $this->objectManager);

        $this->expectException(ResourceAlreadyExistsException::class);

        $createTeam(
            $this->league->getId(),
            $this->team->getId(),
            $this->team->getName(),
            $this->team->getStrip()
        );
    }
}