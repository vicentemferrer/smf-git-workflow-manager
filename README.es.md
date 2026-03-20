[🇬🇧 Read in English](README.md) | 🇪🇸 Leer en Español

# Git Workflow Manager for SMF

![SMF Version](https://img.shields.io/badge/SMF-2.1.*-blue)
![License](https://img.shields.io/github/license/vicentemferrer/smf-git-workflow-manager)
![GitHub Repo stars](https://img.shields.io/github/stars/vicentemferrer/smf-git-workflow-manager?style=social)

**Git Workflow Manager** es un mod para Simple Machines Forum (SMF 2.1) diseñado para facilitar la vida a los desarrolladores y administradores de foros. Te permite gestionar los cambios en la base de datos y los "hooks" de SMF mediante un sistema de **migraciones versionadas**, al más puro estilo de los frameworks modernos como Laravel o Symfony, pero adaptado de forma nativa al ecosistema de SMF.

En lugar de crear e instalar paquetes `.zip` pesados manualmente cada vez que haces un cambio en tu entorno de desarrollo, con Git Workflow Manager puedes escribir pequeñas clases PHP que ejecutan tus cambios al instante y mantenerlos en control de versiones con Git.

¡Además, puedes empaquetar tus migraciones en un ZIP estándar de SMF con un solo clic para distribuirlas a producción!

---

## ✨ Características Principales

- **Desarrollo Ágil:** Olvídate del ciclo de empacar, desinstalar, instalar y probar. Aplica cambios y reviértelos con un solo clic desde el panel de administración.
- **Versionado Limpio:** Todas tus modificaciones residen en la carpeta `gwm_migrations`, lista para ser controlada por Git.
- **Exportación a Producción:** Genera un paquete instalable `.zip` estándar de SMF con todas tus migraciones activas de forma automática.
- **Gestión de Hooks:** Funciones integradas para añadir y remover hooks del sistema sin tocar la base de datos manualmente.

---

## 🚀 Guía Rápida (Easy to Use)

Empezar a usar Git Workflow Manager es muy sencillo:

1. **Instala el Mod:** Sube e instala el paquete en tu foro SMF desde el Administrador de Paquetes.
2. **Crea tu primera migración:** Ve a la carpeta `gwm_migrations` (en la raíz de tu foro) y crea un archivo PHP llamado `MiPrimeraMigracion.php`.

```php
<?php
use GitWorkflowManager\AbstractMigration;

class MiPrimeraMigracion extends AbstractMigration {

    // El método up() se ejecuta al "Aplicar" la migración
    public function up() {
        // Agrega un hook o modifica la base de datos
        $this->add_hook('integrate_pre_include', 'MiMod_FuncionPreInclude');
    }

    // El método down() se ejecuta al "Revertir" la migración
    public function down() {
        // Revierte los cambios
        $this->remove_hook('integrate_pre_include', 'MiMod_FuncionPreInclude');
    }
}
```

3. **Gestiona tus Migraciones:** Dirígete al Panel de Administración de SMF -> Paquetes -> **Git Workflow Manager**. Allí verás tu nueva clase lista para ser aplicada o revertida.

---

## 📚 Documentación

Si necesitas extender funcionalidades complejas de base de datos o administrar las configuraciones, te invitamos a consultar la **[Documentación Oficial de la API](docs/README.es.md)** para ver la lista completa de métodos disponibles en `AbstractMigration`.

## 📜 Licencia

Este proyecto está bajo la [Licencia MIT](LICENSE) - © vicentemferrer.
