(function() {
  tinymce.create('tinymce.plugins.shortcodes', {

    init : function(ed, url) {

      ed.addButton('accordion', {
        title : 'Accordion',
        image : url+'/images/accordion.png',
        onclick : function() {
          ed.execCommand('mceInsertContent', false, '[accordion id="ac1"][accordion_element heading="HERE" pid="ac1"]CONTENT[/accordion_element][/accordion]');
        }
      });

    },

    createControl : function(n, cm) {
      return null;
    },

    getInfo : function() {
      return {
        longname : "Shortcodes",
      };
    }
  });
  tinymce.PluginManager.add('shortcodes', tinymce.plugins.shortcodes);
})();