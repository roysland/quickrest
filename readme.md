# Introduction
A no-framework way for building a REST-API. Not battle-tested in any way. The goal was to build a REST API with just the necessary tools, without bloating it with dependencies. Currently, it only used AltoRouter as a dependency. 

No plans to conform to any PSR-specification. No DIC, pretty much as barebones as it gets.

# Features
* Router for proper REST-API style urls
* Can attach middleware/hooks to routes (per route as of now)
* Handle CORS-preflight

# Install
```bash
git clone https://github.com/roysland/quickrest.git project
cd project
composer install
```

# Usage
It's not a library. Just edit the files.