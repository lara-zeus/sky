---
title: Custom Editor
weight: 3
---

## Content Editor

the default editor is: `MarkdownEditor`. and also included:

* [RichEditor](https://filamentphp.com/docs/3.x/forms/fields/rich-editor)
* [MarkdownEditor](https://filamentphp.com/docs/3.x/forms/fields/markdown-editor)
* [Tiptap Editor](https://filamentphp.com/plugins/tiptap)
* [Tiny Editor](https://filamentphp.com/plugins/mohamedsabil83-tinyeditor)

to use them you only need to install the package, and set the `editor` in `zeus-sky` 

```php
/**
 * the default editor for pages and posts, Available:
 * \LaraZeus\Sky\Editors\TipTapEditor::class,
 * \LaraZeus\Sky\Editors\TinyEditor::class,
 * \LaraZeus\Sky\Editors\MarkdownEditor::class,
 * \LaraZeus\Sky\Editors\RichEditor::class,
 */
'editor' => \LaraZeus\Sky\Editors\RichEditor::class,
```

### Customize the editor

in some cases you may want to use some options with the editor, like uploading to S3 or adding or removing toolbar buttons.
to do so, you need to copy the class to your app or create a new editor.
this way you will have the editor class available to you to add any more options:

```php
MarkdownEditor::make('content')
    ->fileAttachmentsDisk('s3')
    ->fileAttachmentsDirectory('attachments')
    ->fileAttachmentsVisibility('private')
```

### adding new editor

you can add any editor available in [filament plugin directory](https://filamentphp.com/plugins)

* first install the plugin that you want to use.
* implement the `\LaraZeus\Sky\Editors\ContentEditor` interface, and set it in the config file `zeus-sky.php` in the `editor` option
