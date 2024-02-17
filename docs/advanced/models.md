---
title: Custom Models
weight: 8
---

## Custom Models

you can override all the models in the [configuration guid](https://larazeus.com/docs/sky/v3/getting-started/configuration)

first create a new model:

```bash
php artisan make:model Post
```

edit the new file to extend zeus post model:

```php
extend \LaraZeus\Sky\Models\Post
```

and set it in the config.

### author model

by default Sky uses the default user model available in laravel:
`auth.providers.users.model`

to use other model you can overwrite the `auth` relation

for example to use [LDAPRecord](https://ldaprecord.com/docs/laravel/v3/auth/database/configuration#introduction).

the belongs to relation needs to look back at the database model rather than the LDAP model.

```php
public function author(): BelongsTo
{
   return $this->belongsTo(config('auth.providers.authors.model'), 'user_id', 'id');
}
```