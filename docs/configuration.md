---
title: Configuration
weight: 3
---

## Configuration

to publish the config file run the command:

```bash
php artisan vendor:publish --tag=zeus-sky-config
```

you can pass `--force` option to force publishing the config file

### Content Editor

the default editor is: `TinyEditor`. and included:
* [Spatie Markdown Editor](https://filamentphp.com/plugins/spatie-markdown-editor)
* [Tiptap Editor](https://filamentphp.com/plugins/tiptap)

to use them you only need to install the packages, and set the config 'editor'

### adding new editor

you can add any editor available in [filament plugin directory](https://filamentphp.com/plugins)
* first install the plugin that you want to use.
* implement the `\LaraZeus\Sky\Classes\ContentEditor` interface, and set it in the option `editor`

for example check `LaraZeus\Sky\Classes\MarkdownEditor`.
