Alice Fixtures Module: Load Fixtures
====================================
A library to load Alice fixtures suporting ODM and ORM.

This library is based on [KnpLabs/rad-fixtures-load](https://github.com/KnpLabs/rad-fixtures-load) and uses the awesome [nelmio/alice](https://github.com/nelmio/alice) library.

#Installation

```bash
composer require leandro-lugaresi/alice-fixtures-module ~0.0
```

```php
return array(
    'modules' => array(
        'ApplicationExample',
        'AliceFixturesModule'
        ...
    ),
```

#Usages

Inside your module, you have to store your Alice fixtures files into `Module/fixtures/alice`.

##Load fixtures of all modules

Just run the command

```bash
./vendor/bin/doctrine-module alice-fixtures:load 
```

##Load fixtures of specific modules

I've got two modules, `App` and `Api`.

```bash
./vendor/bin/doctrine-module alice-fixtures:load -b App -b Api
```

The order is important. Fixtures will be loaded following this order.

##Use file filtering

If I run this command

```bash
./vendor/bin/doctrine-module alice-fixtures:load -f dev
```

All files finishing with `.dev.yml` will be loaded. And just those files.

You can also chain filters.

```bash
./vendor/bin/doctrine-module alice-fixtures:load -f dev -f test
```

In this case, order doesn't have any importance.

#TO-DO
 
- [ ] Add suport to Providers
- [ ] Add suport do Processors
- [ ] Add command to import ORM DataFixtures
- [ ] Add command to import ODM DataFixtures
