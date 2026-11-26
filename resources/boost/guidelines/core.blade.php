## Lara Zeus Sky (`lara-zeus/sky`)

Lara Zeus Sky is a Filament v5 CMS package providing posts, pages, tags/categories, FAQs, a media/file library, and a navigation menu builder with frontend Livewire routes and headless mode support.

### Key Classes & Components
- Plugin: `LaraZeus\Sky\SkyPlugin` (ID: `zeus-sky`)
- Service provider: `LaraZeus\Sky\SkyServiceProvider` (`$name = 'zeus-sky'`)
- Filament resources (`LaraZeus\Sky\Filament\Resources\*`): `PostResource`, `PageResource`, `FaqResource`, `LibraryResource`, `TagResource`, `NavigationResource`
- Models (`LaraZeus\Sky\Models\*`): `Post`, `Faq`, `Library`, `Tag`, `Navigation` (`Navigation::fromHandle(string $handle)`)
- Enum: `LaraZeus\Sky\Enums\PostStatus`
- Editors: `LaraZeus\Sky\Editors\RichEditor`, `MarkdownEditor`, `TinyEditor`; contract `LaraZeus\Sky\Classes\ContentEditor`
- Frontend Livewire components (`LaraZeus\Sky\Livewire\*`): `Posts`, `Post`, `Page`, `Tags`, `Faq`, `Library`, `LibraryItem`, `LibraryTag`

### Rules & Anti-Patterns
- Register `SpatieTranslatablePlugin::make()->defaultLocales([...])` alongside `SkyPlugin::make()` in your Filament panel, because `Post`, `Faq`, `Library`, and `Tag` use `Spatie\Translatable\HasTranslations`.
- Custom content editors must implement `LaraZeus\Sky\Classes\ContentEditor` (under `Classes`, not `Editors`).
- Set `'headless' => true` in `config/zeus-sky.php` if you only want the Filament admin CMS without registering frontend `routes/web.php`.
- Do not call `vendor:publish` alone without Spatie dependencies' migrations: `php artisan sky:install` also publishes `Spatie\Tags\TagsServiceProvider` (`tags-migrations`) and `medialibrary-migrations`.
