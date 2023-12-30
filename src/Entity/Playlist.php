<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToMany(targetEntity: Music::class, mappedBy: 'playlists')]
    private Collection $music;

    #[ORM\Column(length: 255)]
    private ?string $musics = null;

    public function __construct()
    {
        $this->music = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }


    public function getCreatedAt(): ?\DateTimeImmutable
{
    return $this->created_at;
}

public function setCreatedAt(\DateTimeImmutable $created_at): static
{
    $this->created_at = $created_at;
    
    return $this;
}

/**
 * @return Collection<int, Music>
 */
public function getMusic(): Collection
{
    return $this->music;
}

public function addMusic(Music $music): static
{
    if (!$this->music->contains($music)) {
        $this->music->add($music);
        $music->addPlaylist($this);
    }

    return $this;
}

public function removeMusic(Music $music): static
{
    if ($this->music->removeElement($music)) {
        $music->removePlaylist($this);
    }

    return $this;
}

public function getMusics(): ?string
{
    return $this->musics;
}

public function setMusics(string $musics): static
{
    $this->musics = $musics;

    return $this;
}

    
}

