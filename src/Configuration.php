<?php

namespace LaraZeus\Sky;

use Closure;

trait Configuration
{
    /**
     * @deprecated deprecated since version 3.2
     * set the default path for the blog homepage.
     */
    protected Closure | string $skyPrefix = 'sky';

    /**
     * @deprecated deprecated since version 3.2
     * the middleware you want to apply on all the blog routes
     * for example if you want to make your blog for users only, add the middleware 'auth'.
     */
    protected array $skyMiddleware = ['web'];

    /**
     * @deprecated deprecated since version 3.2
     * URI prefix for each content type
     */
    protected array $uriPrefix = [
        'post' => 'post',
        'page' => 'page',
        'library' => 'library',
        'faq' => 'faq',
    ];

    protected Closure | string $navigationGroupLabel = 'Sky';

    /**
     * you can overwrite any model and use your own
     *
     * @deprecated deprecated since version 3.2
     */
    protected array $skyModels = [];

    /**
     * the default editor for pages and posts, Available:
     * \LaraZeus\Sky\Editors\TipTapEditor::class,
     * \LaraZeus\Sky\Editors\TinyEditor::class,
     * \LaraZeus\Sky\Editors\MarkdownEditor::class,
     * \LaraZeus\Sky\Editors\RichEditor::class,
     *
     * @deprecated deprecated since version 3.2
     */
    protected string $editor = Editors\MarkdownEditor::class;

    /**
     * @deprecated deprecated since version 3.2
     *
     * parse the content
     * you can add any parser to do str_replace or any other operation:
     *
     * to render Blot form by it slug: \LaraZeus\Sky\Classes\BoltParser::class,
     */
    protected array $parsers = [
        \LaraZeus\Sky\Classes\BoltParser::class,
    ];

    /**
     * @deprecated deprecated since version 3.2
     *
     * for the frontend
     */
    protected int $recentPostsLimit = 5;

    /**
     * @deprecated deprecated since version 3.2
     *
     * css class to apply on found search result, e.g. `bg-yellow-400`.
     */
    protected string $searchResultHighlightCssClass = 'highlight';

    /**
     * @deprecated deprecated since version 3.2
     *
     * supply a list of terms that will disable the search highlight to not
     * destroy html structure.
     */
    protected array $skipHighlightingTerms = ['iframe'];

    /**
     * @deprecated deprecated since version 3.2
     *
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

    /**
     * where to upload all files when using the file upload field
     */
    protected Closure | string $uploadDisk = 'public';

    /**
     * the directory name
     */
    protected Closure | string $uploadDirectory = '';

    protected bool $hasPostResource = true;

    protected bool $hasPageResource = true;

    protected bool $hasFaqResource = true;

    protected bool $hasLibraryResource = true;

    /*
     * @deprecated deprecated since version 3.2
     */
    public function skyPrefix(Closure | string $prefix): static
    {
        $this->skyPrefix = $prefix;

        return $this;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function getSkyPrefix(): Closure | string
    {
        return $this->evaluate($this->skyPrefix);
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function skyMiddleware(array $middleware): static
    {
        $this->skyMiddleware = $middleware;

        return $this;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function getMiddleware(): array
    {
        return $this->skyMiddleware;
    }

    public function navigationGroupLabel(Closure | string $lable): static
    {
        $this->navigationGroupLabel = $lable;

        return $this;
    }

    public function getNavigationGroupLabel(): Closure | string
    {
        return $this->evaluate($this->navigationGroupLabel);
    }

    public function skyModels(array $models): static
    {
        $this->skyModels = $models;

        return $this;
    }

    public function getSkyModels(): array
    {
        return $this->skyModels;
    }

    public static function getModel(string $model): string
    {
        return array_merge(
            config('zeus-sky.models'),
            (new static())::get()->getSkyModels()
        )[$model];
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function editor(string $editor): static
    {
        $this->editor = $editor;

        return $this;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function getEditor(): string
    {
        return $this->editor;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function parsers(array $parsers): static
    {
        $this->parsers = $parsers;

        return $this;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function getParsers(): array
    {
        return $this->parsers;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function recentPostsLimit(int $limit): static
    {
        $this->recentPostsLimit = $limit;

        return $this;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
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

    /*
     * @deprecated deprecated since version 3.2
     */
    public function uriPrefix(array $prefix): static
    {
        $this->uriPrefix = $prefix;

        return $this;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function getUriPrefix(): array
    {
        return $this->uriPrefix;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function searchResultHighlightCssClass(string $class): static
    {
        $this->searchResultHighlightCssClass = $class;

        return $this;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function getSearchResultHighlightCssClass(): string
    {
        return $this->searchResultHighlightCssClass;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function skipHighlightingTerms(array $skip): static
    {
        $this->skipHighlightingTerms = $skip;

        return $this;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function getSkipHighlightingTerms(): array
    {
        return $this->skipHighlightingTerms;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function defaultFeaturedImage(string $image): static
    {
        $this->defaultFeaturedImage = $image;

        return $this;
    }

    /*
     * @deprecated deprecated since version 3.2
     */
    public function getDefaultFeaturedImage(): ?string
    {
        return $this->defaultFeaturedImage;
    }

    public function uploadDisk(Closure | string $disk): static
    {
        $this->uploadDisk = $disk;

        return $this;
    }

    public function getUploadDisk(): Closure | string
    {
        return $this->evaluate($this->uploadDisk);
    }

    public function uploadDirectory(Closure | string $dir): static
    {
        $this->uploadDirectory = $dir;

        return $this;
    }

    public function getUploadDirectory(): Closure | string
    {
        return $this->evaluate($this->uploadDirectory);
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
}
