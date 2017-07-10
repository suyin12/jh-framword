// JavaScript Document
$(document).ready(function(){
	      

	
                // onHide : fade the window out, remove overlay after fade.
                var myClose = function(hash){
                    hash.w.fadeOut('3000', function(){
                        hash.o.remove();
                    });
                };
                var openInIframe = function(hash){
                    var newWidth = 0, newHeight = 0, newLeft = 0, newTop = 0;
                    var $trigger = $(hash.t);
                    var $modal = $(hash.w);
                    var myUrl = $trigger.attr('href');
                    var myTitle = $trigger.attr('title');
                    var $modalContent = $("iframe", $modal);

                    $modalContent.html('').attr('src', myUrl);
                    //let's use the anchor "title" attribute as modal window title
                    $('#jqmTitleText').text(myTitle);

                    myUrl = (myUrl.lastIndexOf("#") > -1) ? myUrl.slice(0, myUrl.lastIndexOf("#")) : myUrl;
                    var queryString = (myUrl.indexOf("?") > -1) ? myUrl.substr(myUrl.indexOf("?") + 1) : null;

                    if (queryString != null && typeof queryString != 'undefined') {
                        var queryVarsArray = queryString.split("&");
                        for (var i = 0; i < queryVarsArray.length; i++) {
                            if (unescape(queryVarsArray[i].split("=")[0]) == 'width') {
                                var newWidth = queryVarsArray[i].split("=")[1];
                            }
                            if (escape(unescape(queryVarsArray[i].split("=")[0])) == 'height') {
                                var newHeight = queryVarsArray[i].split("=")[1];
                            }
                        }
                        // let's run through all possible values: 90%, nothing or a value in pixel
                        if (newHeight != 0) {
                            if (newHeight.indexOf('%') > -1) {
                                newHeight = Math.floor(parseInt($(window).height()) * (parseInt(newHeight) / 100));
                            }
                            var newTop = Math.floor(parseInt($(window).height() - newHeight) / 2);
                        }
                        else {
                            newHeight = $modal.height();
                        }
                        if (newWidth != 0) {
                            if (newWidth.indexOf('%') > -1) {
                                newWidth = Math.floor(parseInt($(window).width() / 100) * parseInt(newWidth));
                            }
                            var newLeft = Math.floor(parseInt($(window).width() / 2) - parseInt(newWidth) / 2);

                        }
                        else {
                            newWidth = $modal.width();
                        }
                        // do the animation so that the windows stays on center of screen despite resizing
                        $modal.jqmShow().animate({
                            width: newWidth,
                            height: newHeight,
                            top: newTop,
                            left: newLeft,
                            marginLeft: 0
                        }, 2000);
                    }

                    else {
                        // don't do animations
                        $modal.jqmShow();
                    }
                }

                //thickbox replacement
                $('#modalWindow').jqm({
                    modal: true,
                    trigger: 'a.thickbox',
                    target: '#jqmContent',
                    onHide: myClose,
                    onShow: openInIframe
                });


        
 
   
            })