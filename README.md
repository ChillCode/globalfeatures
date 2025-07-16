# 🧩 GlobalFeatures

> **⚠️ Developer Note:** This module is intended for development and debugging purposes only. Not recommended for production use.

[![PrestaShop 9.0+](https://img.shields.io/badge/PrestaShop-9.0+-blue?logo=prestashop&logoColor=white)](https://www.prestashop-project.org/)
[![PHP 8.1+](https://img.shields.io/badge/PHP-8.1+-777bb4?logo=php&logoColor=white)](https://www.php.net/)
[![Symfony 6.4](https://img.shields.io/badge/Symfony-6.4-black?logo=symfony&logoColor=white)](https://symfony.com/)
[![Dev Only](https://img.shields.io/badge/status-development-orange)]()

## 🚀 Overview

`GlobalFeatures` is a PrestaShop 9.0.0 development module that attempts to address several issues related to cache handling in the new Symfony-based architecture.

Due to the current state of caching in PrestaShop 9 (many cache mechanisms are marked as _WIP_), this module provides insights and recommendations for module developers working with the Symfony container and cache system.

---

## 🧪 Compatibility

- ✅ **Tested with PHP 8.1+**
- ✅ **Designed for PrestaShop 9.x (Symfony Core)**

---

## 📦 Development Note

> This repository is intended for **development and demonstration purposes only**.  
> The production-tested version of this module with other utilities and commands is maintained privately.

---

## 💡 Background

In PrestaShop 9, the **`Modules`** folder is **passed** to twig warmer meaning thousands of files are parsed:

To work around this:
- Use file_name_pattern https://symfony.com/doc/current/reference/configuration/twig.html#file-name-pattern

In PrestaShop 9, the **`Environment`** service is **manually initialized** in the Front Office, meaning:
- Service injection via decoration or overriding **will not work** for `Environment` in FO but works in BO.

To work around this:
- The only solution is **Overriding `Hook` and `ContainerBuilder` classes** to make it work in FO witouht hacking the core.
- Better ***to directly edit** `src/Adapter/Environment.php` and add an additional method called getAppIdCacheDir() that returns the correct path in ContainerBuilder.php.


```
    /**
     * {@inheritdoc}
     */
    public function getAppIdCacheDir()
    {
        return _PS_ROOT_DIR_ . '/var/cache/' . $this->getName() . '/' . $this->getAppId() . '/';
    }
```
Usage in buildContainer:

`$this->dumpFile = $this->environment->getAppIdCacheDir() . DIRECTORY_SEPARATOR . $this->containerClassName . '.php';`

Editing enviorement getCacheDir could be a BC because since is used to set `%kernel_cache_dir%`

---

## 🛠️ Cache Handling Recommendations

 - Use cache pools for your own modules.

 - Do not use `_PS_CACHE_DIR_` in your modules.

Modules using `_PS_CACHE_DIR_`

- ps_mainmenu
- ps_themecusto

### 🔁 Clear All Caches

If you're developing modules or debugging caching behavior, consider editing CacheClearCommand to add your logic:

```php
src/Command/CacheClearCommand.php
