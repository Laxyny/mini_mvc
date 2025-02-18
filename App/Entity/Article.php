<?php

namespace App\Entity;


class Article extends Entity
{
    protected ?int $id = null;
    protected ?string $title = '';
    protected ?string $description = '';

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function validate(): array
    {
        $errors = [];
        if (empty($this->getTitle())) {
            $errors['title'] = 'Le champ title ne doit pas être vide';
        }
        if (empty($this->getDescription())) {
            $errors['description'] = 'Le champ description ne doit pas être vide';
        }
        return $errors;
    }
}
