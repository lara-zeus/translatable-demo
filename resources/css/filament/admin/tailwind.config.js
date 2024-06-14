import preset from '../../../../vendor/filament/filament/tailwind.config.preset';

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/filament-curator/resources/**/*.blade.php',
        './vendor/z3d0x/filament-fabricator/resources/**/*.blade.php',
        './vendor/voltra/filament-svg-avatar/resources/**/*.blade.php',
    ],
};
