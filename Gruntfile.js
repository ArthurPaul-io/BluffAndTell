module.exports = function(grunt) {
    // Configuration des tâches
    grunt.initConfig({
      pkg: grunt.file.readJSON('package.json'),
      // Exemple de tâche de minification
      uglify: {
        options: {
          banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
        },
        build: {
          src: 'src/<%= pkg.name %>.js',
          dest: 'build/<%= pkg.name %>.min.js'
        }
      }
    });
  
    // Charger les plugins nécessaires
    grunt.loadNpmTasks('grunt-contrib-uglify');
  
    // Définir les tâches par défaut
    grunt.registerTask('default', ['uglify']);
  };