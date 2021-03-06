<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorksRepository")
 */
class Works
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $collection;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $periodStart;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $periodEnd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $technique;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $locationName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $locationCity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionUrl;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $creationDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $authorName;

    /**
     * @ORM\Column(type="integer", nullable=true , name="authorApiId" )
     */
    private $authorApiId;

    /**
     * @ORM\Column(type="integer", name="ApiId")
     */
    private $apiId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $badgeId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="works")
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Liked", mappedBy="works", orphanRemoval=true)
     */
    private $likes;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @param array $data
     * @return string
     */
    public function hydrate(array $data): string
    {
        foreach ($data as $key => $value) {
            if ($key == 'creationDate' && $value == null) {
                unset($data[$key]);
            } else if ($key == 'author') {
                unset($data[$key]);
            } else {

                if (property_exists($this, $key)) {
                    $this->$key = $value;
                    unset($data[$key]);
                }
            }
        }
        // control des infos non hydratées
        $msg = '';
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $msg .= 'key:' . $key . ' value:' . $value . '<br>';
            }
        }

        return $msg;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCollection(): ?string
    {
        return $this->collection;
    }

    public function setCollection(?string $collection): self
    {
        $this->collection = $collection;

        return $this;
    }

    public function getPeriodStart(): ?string
    {
        return $this->periodStart;
    }

    public function setPeriodStart(?string $periodStart): self
    {
        $this->periodStart = $periodStart;

        return $this;
    }

    public function getPeriodEnd(): ?string
    {
        return $this->periodEnd;
    }

    public function setPeriodEnd(?string $periodEnd): self
    {
        $this->periodEnd = $periodEnd;

        return $this;
    }

    public function getTechnique(): ?string
    {
        return $this->technique;
    }

    public function setTechnique(?string $technique): self
    {
        $this->technique = $technique;

        return $this;
    }

    public function getLocationName(): ?string
    {
        return $this->locationName;
    }

    public function setLocationName(?string $locationName): self
    {
        $this->locationName = $locationName;

        return $this;
    }

    public function getLocationCity(): ?string
    {
        return $this->locationCity;
    }

    public function setLocationCity(?string $locationCity): self
    {
        $this->locationCity = $locationCity;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getDescriptionUrl(): ?string
    {
        return $this->descriptionUrl;
    }

    public function setDescriptionUrl(?string $descriptionUrl): self
    {
        $this->descriptionUrl = $descriptionUrl;

        return $this;
    }

    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    public function setAuthorName(?string $authorName): self
    {
        $this->authorName = $authorName;

        return $this;
    }

    public function getAuthorApiId(): ?int
    {
        return $this->authorApiId;
    }

    public function setAuthorApiId(?int $authorApiId): self
    {
        $this->authorApiId = $authorApiId;

        return $this;
    }

    public function getApiId(): ?int
    {
        return $this->apiId;
    }

    public function setApiId(int $apiId): self
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function getBadgeId(): ?int
    {
        return $this->badgeId;
    }

    public function setBadgeId(?int $badgeId): self
    {
        $this->badgeId = $badgeId;

        return $this;
    }

    public function getCreationDate(): ?int
    {
        return $this->creationDate;
    }

    public function setCreationDate(?int $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Liked[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Liked $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setWorks($this);
        }

        return $this;
    }

    public function removeLike(Liked $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getWorks() === $this) {
                $like->setWorks(null);
            }
        }

        return $this;
    }

}
