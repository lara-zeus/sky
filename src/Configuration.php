<?php

namespace LaraZeus\Sky;

trait Configuration
{
    protected bool $hasPostResource = true;

    protected bool $hasPageResource = true;

    protected bool $hasFaqResource = true;

    protected bool $hasLibraryResource = true;

    protected string $navigationGroupLabel = 'sky';

    protected string $faqModel = \LaraZeus\Sky\Models\Faq::class;

    protected string $postModel = \LaraZeus\Sky\Models\Post::class;

    protected string $postStatusModel = \LaraZeus\Sky\Models\PostStatus::class;

    protected string $tagModel = \LaraZeus\Sky\Models\Tag::class;

    protected string $libraryModel = \LaraZeus\Sky\Models\Library::class;

    /**
     * the default editor for pages and posts, Available:
     * \LaraZeus\Sky\Classes\TipTapEditor::class,
     * \LaraZeus\Sky\Classes\TinyEditor::class,
     * \LaraZeus\Sky\Classes\MarkdownEditor::class,
     */
    protected string $editor = \LaraZeus\Sky\Classes\TipTapEditor::class;

    public function postResource(bool $condition = true): static
    {
        $this->hasPostResource = $condition;

        return $this;
    }

    public function hasPostResource(): bool
    {
        return $this->hasPostResource;
    }

    public function pageResource(bool $condition = true): static
    {
        $this->hasPageResource = $condition;

        return $this;
    }

    public function hasPageResource(): bool
    {
        return $this->hasPageResource;
    }

    public function faqResource(bool $condition = true): static
    {
        $this->hasFaqResource = $condition;

        return $this;
    }

    public function hasFaqResource(): bool
    {
        return $this->hasFaqResource;
    }

    public function libraryResource(bool $condition = true): static
    {
        $this->hasLibraryResource = $condition;

        return $this;
    }

    public function hasLibraryResource(): bool
    {
        return $this->hasLibraryResource;
    }

    public function navigationGroupLabel(string $lable): static
    {
        $this->navigationGroupLabel = $lable;

        return $this;
    }

    public function getNavigationGroupLabel(): string
    {
        return $this->navigationGroupLabel;
    }

    public function faqModel(string $model): static
    {
        $this->faqModel = $model;

        return $this;
    }

    public function getFaqModel(): string
    {
        return $this->faqModel;
    }

    public function postModel(string $model): static
    {
        $this->postModel = $model;

        return $this;
    }

    public function getPostModel(): string
    {
        return $this->postModel;
    }

    public function postStatusModel(string $model): static
    {
        $this->postStatusModel = $model;

        return $this;
    }

    public function getPostStatusModel(): string
    {
        return $this->postStatusModel;
    }

    public function tagModel(string $model): static
    {
        $this->tagModel = $model;

        return $this;
    }

    public function getTagModel(): string
    {
        return $this->tagModel;
    }

    public function libraryModel(string $model): static
    {
        $this->libraryModel = $model;

        return $this;
    }

    public function getLibraryModel(): string
    {
        return $this->libraryModel;
    }

    public function editor(string $editor): static
    {
        $this->editor = $editor;

        return $this;
    }

    public function getEditor(): string
    {
        return $this->editor;
    }
}
