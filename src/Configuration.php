<?php

namespace LaraZeus\Sky;

trait Configuration
{
    /**
     * set the default path for the blog homepage.
     */
    protected string $skyPrefix = 'sky';

    /**
     * the middleware you want to apply on all the blog routes
     * for example if you want to make your blog for users only, add the middleware 'auth'.
     */
    protected array $skyMiddleware = ['web'];

    /**
     * URI prefix for each content type
     */
    protected array $uriPrefix = [
        'post' => 'post',
        'page' => 'page',
        'library' => 'library',
        'faq' => 'faq',
    ];

    protected bool $hasPostResource = true;

    protected bool $hasPageResource = true;

    protected bool $hasFaqResource = true;

    protected bool $hasLibraryResource = true;

    protected string $navigationGroupLabel = 'Sky';

    protected string $faqModel = \LaraZeus\Sky\Models\Faq::class;

    protected string $postModel = \LaraZeus\Sky\Models\Post::class;

    protected string $postStatusModel = \LaraZeus\Sky\Models\PostStatus::class;

    protected string $tagModel = \LaraZeus\Sky\Models\Tag::class;

    protected string $libraryModel = \LaraZeus\Sky\Models\Library::class;

    /**
     * the default editor for pages and posts, Available:
     * \LaraZeus\Sky\Editors\TipTapEditor::class,
     * \LaraZeus\Sky\Editors\TinyEditor::class,
     * \LaraZeus\Sky\Editors\MarkdownEditor::class,
     */
    protected string $editor = Editors\TipTapEditor::class;

    /**
     * parse the content
     * you can add any parser to do str_replace or any other operation:
     *
     * to render Blot form by it slug: \LaraZeus\Sky\Classes\BoltParser::class,
     */
    protected array $parsers = [
        \LaraZeus\Sky\Classes\BoltParser::class,
    ];

    /**
     * for the frontend
     */
    protected int $recentPostsLimit = 5;

    /**
     * css class to apply on found search result, e.g. `bg-yellow-400`.
     */
    protected string $searchResultHighlightCssClass = 'highlight';

    /**
     * supply a list of terms that will disable the search highlight to not
     * destroy html structure.
     */
    protected array $skipHighlightingTerms = ['iframe'];

    /**
     * default featured image, set to null to disable it.
     * ex: https://placehold.co/600x400
     */
    protected ?string $defaultFeaturedImage = null;

    protected ?array $libraryTypes = [
        'FILE' => 'File',
        'IMAGE' => 'Image',
        'VIDEO' => 'Video',
    ];

    protected ?array $tagTypes = [
        'tag' => 'Tag',
        'category' => 'Category',
        'library' => 'Library',
        'faq' => 'Faq',
    ];

    public function skyPrefix(string $prefix): static
    {
        $this->skyPrefix = $prefix;

        return $this;
    }

    public function getSkyPrefix(): string
    {
        return $this->skyPrefix;
    }

    public function skyMiddleware(array $middleware): static
    {
        $this->skyMiddleware = $middleware;

        return $this;
    }

    public function getMiddleware(): array
    {
        return $this->skyMiddleware;
    }

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

    public function parsers(array $parsers): static
    {
        $this->parsers = $parsers;

        return $this;
    }

    public function getParsers(): array
    {
        return $this->parsers;
    }

    public function recentPostsLimit(int $limit): static
    {
        $this->recentPostsLimit = $limit;

        return $this;
    }

    public function getRecentPostsLimit(): int
    {
        return $this->recentPostsLimit;
    }

    public function libraryTypes(array $types): static
    {
        $this->libraryTypes = $types;

        return $this;
    }

    public function getLibraryTypes(): ?array
    {
        return $this->libraryTypes;
    }

    public function tagTypes(array $types): static
    {
        $this->tagTypes = $types;

        return $this;
    }

    public function getTagTypes(): ?array
    {
        return $this->tagTypes;
    }

    public function uriPrefix(array $prefix): static
    {
        $this->uriPrefix = $prefix;

        return $this;
    }

    public function getUriPrefix(): array
    {
        return $this->uriPrefix;
    }

    public function searchResultHighlightCssClass(string $class): static
    {
        $this->searchResultHighlightCssClass = $class;

        return $this;
    }

    public function getSearchResultHighlightCssClass(): string
    {
        return $this->searchResultHighlightCssClass;
    }

    public function skipHighlightingTerms(array $skip): static
    {
        $this->skipHighlightingTerms = $skip;

        return $this;
    }

    public function getSkipHighlightingTerms(): array
    {
        return $this->skipHighlightingTerms;
    }

    public function defaultFeaturedImage(string $image): static
    {
        $this->defaultFeaturedImage = $image;

        return $this;
    }

    public function getDefaultFeaturedImage(): ?string
    {
        return $this->defaultFeaturedImage;
    }
}
