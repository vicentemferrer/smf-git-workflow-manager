🇬🇧 Read in English | [🇪🇸 Leer en Español](README.es.md)

# Git Workflow Manager for SMF

![SMF Version](https://img.shields.io/badge/SMF-2.1.*-blue)
![License](https://img.shields.io/github/license/vicentemferrer/smf-git-workflow-manager)
![GitHub Repo stars](https://img.shields.io/github/stars/vicentemferrer/smf-git-workflow-manager?style=social)

**Git Workflow Manager** is a mod for Simple Machines Forum (SMF 2.1) designed to make life easier for forum developers and administrators. It allows you to manage database changes and SMF "hooks" through a system of **versioned migrations**, much like modern frameworks such as Laravel or Symfony, but adapted natively to the SMF ecosystem.

Instead of manually creating and installing heavy `.zip` packages every time you make a change in your development environment, Git Workflow Manager lets you write small PHP classes that execute your changes instantly while keeping them under version control with Git.

Plus, you can package all your migrations into a standard SMF `.zip` installer with a single click for easy deployment to production!

---

## ✨ Features

- **Agile Development:** Forget the loop of packaging, uninstalling, installing, and testing. Apply and revert changes with a single click from the admin panel.
- **Clean Versioning:** All your modifications reside in the `gwm_migrations` folder, ready to be tracked by Git.
- **Production Ready:** Generate a standard SMF installable `.zip` package automatically with all your active migrations.
- **Hook Management:** Built-in functions for adding and removing system hooks without touching the database manually.

---

## 🚀 Quickstart (Easy to Use)

Getting started with Git Workflow Manager is very simple:

1. **Install the Mod:** Upload and install the package on your SMF forum from the Package Manager.
2. **Create your first migration:** Go to the `gwm_migrations` folder (in the root of your forum) and create a PHP file called `MyFirstMigration.php`.

```php
<?php
use GitWorkflowManager\AbstractMigration;

class MyFirstMigration extends AbstractMigration {

    // The up() method executes when "Applying" the migration
    public function up() {
        // Add a hook or modify the database
        $this->add_hook('integrate_pre_include', 'MyMod_PreIncludeFunction');
    }

    // The down() method executes when "Reverting" the migration
    public function down() {
        // Revert the changes
        $this->remove_hook('integrate_pre_include', 'MyMod_PreIncludeFunction');
    }
}
```

3. **Manage your Migrations:** Go to your SMF Admin Panel -> Packages -> **Git Workflow Manager**. There you will see your new class ready to be applied or reverted.

---

## 📚 Documentation

If you need to extend complex database functionalities or manage settings, please check the **[Official API Documentation](docs/README.md)** for a complete list of all available helper methods in `AbstractMigration`.

## 📜 License

This project is licensed under the [MIT License](LICENSE) - © vicentemferrer.
