var gallery = (function(){
    'use strict';
    return {
      // this.js(obj)
      js: function(e){return $("[data-js="+e+"]");},
      // this.lk(obj)
      lk: function(e){return $("[data-lk="+e+"]");},
      // Ready functions
      ready_: function(){this.events();},
      //  functions
      events:function(){
        var self = this;
        var close = $('.gallery_item_full');
        close.append('<a href="#" data-js="cl" class="cl">X</a>');
        // Get all data js and add clickOn function
        var k = $('a[data-js]');
        k.each(function(i, v){
          i = i+1;
          self.clickOn(i);
        });
        // close on click
        self.js('cl').on("click",function(){
          self.fx_out($('.gallery_item_full'));
          self.fx_out($('.box'));
        });
        
        // list
        self.js('list').on("click",function(){
          $('.gallery_item').toggleClass('gallery_item_list');
          $('.gallery_item_preview a img').toggleClass('gallery_line');
        });
      },
      // Show on click
      clickOn: function(i){
        var self = this;
        this.js(i).on('click',function(){
          self.fx_in(self.lk(i)); 
          self.fx_in($('.box'));
        });
      }, 
      // out function
      fx_out: function(el){
        el.addClass('efOut')
        .delay(500)
        .fadeOut('fast')
        .removeClass('efIn');
        $('body').css({overflow:'auto'});
        return false;
      }, 
      // in function
      fx_in: function(el){
        el.removeClass('efOut')
        .show()
        .addClass('efIn');
        $('body').css({overflow:'hidden'});
        return false;
      }
    };
  })();
  // ready function of gallery
  gallery.ready_();



  // form comentario
  $('textarea').keyup(function() {
    
    var characterCount = $(this).val().length,
        current = $('#current'),
        maximum = $('#maximum'),
        theCount = $('#the-count');
      
    current.text(characterCount);
   
    
    /*This isn't entirely necessary, just playin around*/
    if (characterCount < 70) {
      current.css('color', '#666');
    }
    if (characterCount > 70 && characterCount < 90) {
      current.css('color', '#6d5555');
    }
    if (characterCount > 90 && characterCount < 100) {
      current.css('color', '#793535');
    }
    if (characterCount > 100 && characterCount < 120) {
      current.css('color', '#841c1c');
    }
    if (characterCount > 120 && characterCount < 139) {
      current.css('color', '#8f0001');
    }
    
    if (characterCount >= 140) {
      maximum.css('color', '#8f0001');
      current.css('color', '#8f0001');
      theCount.css('font-weight','bold');
    } else {
      maximum.css('color','#666');
      theCount.css('font-weight','normal');
    }
    
        
  });


  