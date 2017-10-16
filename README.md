Yii 2 BlockChain Project
========================

It's a php port of [great project](https://github.com/dvf/blockchain) on python
facilitating understanding blockChain technology
implemented on the Yii2 Framework and based on Yii2 Advanced Project Template, which
includes four tiers: front end, back end, api, and console, each of which
is a separate Yii application.

- Frontend is for info, register and contact.
- Backend is the general web interface of app.
- Console will represent same features by cli interface in future.
- In Api will be same features by http requesting.

You can preview it without installing:
Demo frontend: http://www.okChain.ru, after register your node you'll be redirected to [backend](http://www.okChain.ru)

Description and documentation coming soon, and personally project still under construction..


DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
