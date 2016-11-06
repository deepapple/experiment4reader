
var $appeared = {};
(function ($) {
    $(document).ready(function() {
        console.log('on loadas 3')
        jQuery('.end-of-item').appear();
//        jQuery('.end-of-item').on('click', function(){
//            console.log('clickas');
//            console.log(this);
//            return false;
//        })
//        console.log(jQuery('.end-of-all-items').appear)
        $('.keep-unread').click(function(){
          var id = $(this).data('id')
          $.getJSON('/reader/keep_unread/' + id, function(data){
              $('.item[data-id="' + data.nid + '"]').removeClass('have-read');
          })
          return false;
        })
        jQuery(document.body).on('appear', '.didnt-read .end-of-item', function(e, $affected) {
            var id = $(this).data('id')
            if(typeof $appeared[id] == 'undefined'){
                $appeared[id] = true
                $.getJSON('/reader/mark_as_read/' + id, function(data){
                    $('.item[data-id="' + data.nid + '"]').addClass('have-read');
                })
            }
        })
//        jQuery(document.body).on('disappear', '.end-of-item', function(e, $affected) {
//            console.log('disappear');
//            console.log(this)
//        })
//        console.log(jQuery)
//        jQuery('.end-of-item').appear(function(){
//            console.log('appear');
//            console.log(this)
//        })
//        jQuery('.end-of-all-items').appear(function(){
//            console.log('final ITEM appeared');
//            console.log(this)
//        })
    })
    //alert('aas')
//Drupal.behaviors.tokenTree = {
//  attach: function (context, settings) {
//    $('table.token-tree', context).once('token-tree', function () {
//      $(this).treeTable();
//    });
//  }
//};

//Drupal.behaviors.tokenDialog = {
//  attach: function (context, settings) {
//    $('a.token-dialog', context).once('token-dialog').click(function() {
//      var url = $(this).attr('href');
//      var dialog = $('<div style="display: none" class="loading">' + Drupal.t('Loading token browser...') + '</div>').appendTo('body');
//
//      // Emulate the AJAX data sent normally so that we get the same theme.
//      var data = {};
//      data['ajax_page_state[theme]'] = Drupal.settings.ajaxPageState.theme;
//      data['ajax_page_state[theme_token]'] = Drupal.settings.ajaxPageState.theme_token;
//
//      dialog.dialog({
//        title: $(this).attr('title') || Drupal.t('Available tokens'),
//        width: 700,
//        close: function(event, ui) {
//          dialog.remove();
//        }
//      });
//      // Load the token tree using AJAX.
//      dialog.load(
//        url,
//        data,
//        function (responseText, textStatus, XMLHttpRequest) {
//          dialog.removeClass('loading');
//        }
//      );
//      // Prevent browser from following the link.
//      return false;
//    });
//  }
//}

//Drupal.behaviors.tokenInsert = {
//  attach: function (context, settings) {
//    // Keep track of which textfield was last selected/focused.
//    $('textarea, input[type="text"]', context).focus(function() {
//      Drupal.settings.tokenFocusedField = this;
//    });
//
//    $('.token-click-insert .token-key', context).once('token-click-insert', function() {
//      var newThis = $('<a href="javascript:void(0);" title="' + Drupal.t('Insert this token into your form') + '">' + $(this).html() + '</a>').click(function(){
//        if (typeof Drupal.settings.tokenFocusedField == 'undefined') {
//          alert(Drupal.t('First click a text field to insert your tokens into.'));
//        }
//        else {
//          var myField = Drupal.settings.tokenFocusedField;
//          var myValue = $(this).text();
//
//          //IE support
//          if (document.selection) {
//            myField.focus();
//            sel = document.selection.createRange();
//            sel.text = myValue;
//          }
//
//          //MOZILLA/NETSCAPE support
//          else if (myField.selectionStart || myField.selectionStart == '0') {
//            var startPos = myField.selectionStart;
//            var endPos = myField.selectionEnd;
//            myField.value = myField.value.substring(0, startPos)
//                          + myValue
//                          + myField.value.substring(endPos, myField.value.length);
//          } else {
//            myField.value += myValue;
//          }
//
//          $('html,body').animate({scrollTop: $(myField).offset().top}, 500);
//        }
//        return false;
//      });
//      $(this).html(newThis);
//    });
//  }
//};

})(jQuery);
