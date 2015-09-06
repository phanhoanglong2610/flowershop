function setupLabel() {
         if (jQuery('.ModListButtons input').length) {
            jQuery('.ModListButtons').each(function(){ 
                jQuery(this).removeClass('r_on');
            });
            jQuery('.ModListButtons input:checked').each(function(){ 
                jQuery(this).parent('label').addClass('r_on');
            });
        };
    };
    jQuery(document).ready(function(){
        jQuery('body').addClass('has-js');
        jQuery('.ModListButtons').click(function(){
            setupLabel();
        });
        setupLabel(); 
    });
/**
 * cust_select_plugin.js
 * Copyright (c) 2010 myPocket technologies (www.mypocket-technologies.com)
 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.

 * @author Darren Mason (djmason9@gmail.com)
 * @date 5/13/2009
 * @projectDescription Replaces the standard HTML form selectbox with a custom looking selectbox. Allows for disable, multiselect, scrolling, and very customizable.
 * @version 2.1.4
 * 
 * @requires jquery.js (tested with 1.3.2)
 * 
 * @param isscrolling:          false,                          //scrolls long lists
 * @param scrollminitems:       15,                                     //items before scrolling
 * @param scrollheight:         150,                            //height of scrolling window
 * @param preopenselect:        true,                           //opens prechecked select boxes
 * @param hoverstyle:           "hover",                        //css hover style name
 * @param openspeed:            "normal",                       //selectbox open speed "slow","normal","fast" or numbers 1000
 * @param alldisabled:          false,                          //disables all the selectbox
 * @param selectwidth:          "auto",                         //set width of selectbox
 * @param wrappername:          ".select_wrap"          //class name of the wrapper tag
*/
(function(jQuery) {

        jQuery.fn.custSelectBox = function(options){
                
                //css names
                var classselectbox = "selectbox";
                var selectbox = "." + classselectbox;
                var selectboxoptions_wrap = ".selectboxoptions_wrap";
                var hideitem = "hideitem";
                var classselected = "selected";
                var classselectboxopen = "selectboxopen";
                var classselectboxfoot ="selectboxfoot";
                var selectboxfoot = "." +classselectboxfoot;
                var elmValue = ".elmValue";
                
                var defaults = {
                                isscrolling:    true,                           //scrolls long lists
                                scrollminitems: 15,                                     //items before scrolling
                                scrollheight:   150,                            //height of scrolling window
                                preopenselect:  true,                           //opens prechecked select boxes
                                hoverstyle:             "hover",                        //css hover style name
                                openspeed:              "normal",                       //selectbox open speed "slow","normal","fast" or numbers 1000
                                alldisabled:    false,                          //disables the selectbox
                                selectwidth:    "auto",                         //set width of selectbox
                                wrappername:    ".select_wrap"
                        };
                //override defaults
                var opts = jQuery.extend(defaults, options);

                return this.each(function() { 
                
                /** FUNCTIONS **/
                jQuery.fn.disable = function(thisElm){
                        //loop through items
                        for(var i=0;i<jQuery(thisElm).find("ul").find("li").length;i++)
                        {
                                if(jQuery(jQuery(thisElm).find("ul").find("li").get(i)).hasClass(classselected))
                                {
                                        jQuery(jQuery(thisElm).find("ul").find("li").get(i)).addClass("selected_disable");
                                }
                                jQuery(jQuery(thisElm).find("ul").find("li").get(i)).unbind();
                                jQuery(jQuery(thisElm).find("ul").get(i)).find("input").attr("disabled","disabled");
                        }                               
                };
        
                //adds form elements to the selectbox
                jQuery.fn.addformelms = function(thisElm){
                                var currElm = jQuery(thisElm);
                                var boxtype = jQuery(thisElm).find(selectboxoptions_wrap+ " ul").attr("class");
                                
                                if(boxtype.indexOf("selectboxoptions_radio") >-1)
                                {
                                        var radioVal = jQuery(currElm).find("."+classselected+" span").text();
                                        jQuery(currElm).find(selectboxoptions_wrap).append("<input type=\"hidden\" id=\""+jQuery(main_currElm).attr("id")+"\" name=\""+jQuery(main_currElm).attr("name")+"\" value=\""+radioVal+"\">");
                                }
                                else
                                {
                                        for(var i=0;i<jQuery(currElm).find(selectboxoptions_wrap + " li").length;i++)
                                        {
                                                var currInnerElm = jQuery(currElm).find(selectboxoptions_wrap + " li").get(i);
                                                jQuery(currInnerElm).append("<input type=\"hidden\" id=\""+jQuery(main_currElm).attr("id") +"_"+ i+"\" name=\""+jQuery(main_currElm).attr("name") +"_"+ i+"\" value=\"\">");
                                                
                                                if(jQuery(currInnerElm).hasClass(classselected))
                                                {
                                                        var checkVal = jQuery(currInnerElm).find("span").text();
                                                        jQuery(jQuery(currElm).find(selectboxoptions_wrap + " li").get(i)).find("input").val(checkVal);
                                                }
                                        }
                                }
                };
                
                //opens selectboxs if they have pre selected options
                jQuery.fn.openSelectBoxsThatArePrePopulated = function(currElm)
                {
                                var boxtype = jQuery(currElm).find(selectboxoptions_wrap+ " ul").attr("class");
                                
                                if(jQuery(selectbox).parent().find("." +boxtype).find("li").hasClass(classselected))
                                {
                                        jQuery(selectbox).addClass(classselectboxopen);
                                        jQuery(selectbox).parent().find(selectboxoptions_wrap).slideDown("normal");
                                        jQuery(selectbox).parent().find("." +boxtype).find("li").addClass(hideitem);
                                }
                };
                
                jQuery.fn.scrolling = function (theElm, isOpen)
                {
                        if(isOpen)
                        {
                                if(jQuery(theElm).parent().find(selectboxoptions_wrap+ " ul li").length >= opts.scrollminitems){
                                        jQuery(theElm).parent().find(selectboxoptions_wrap+ " ul").css("height",opts.scrollheight).addClass("setScroll");
                                }
                        }
                        else{
                                jQuery(theElm).parent().find(selectboxoptions_wrap+ " ul").css("height","auto").removeClass("setScroll");
                        }
                };
                /** FUNCTIONS **/
                
                //BUILD HTML TO CREATE CUSTOM SELECT BOX
                var main_currElm = jQuery(this);
                var wrapperElm = jQuery(main_currElm).parent();
                var name = "";
                var select_options = jQuery(main_currElm).find("option");
                var opts_str="";
                var isDisabled = jQuery(main_currElm).attr("disabled");
                var isMulti = jQuery(main_currElm).attr("multiple");
                var boxtype = "selectboxoptions_radio";
                var disabled = "";
                
                if(isMulti){boxtype = "selectboxoptions_check";}
                if(isDisabled){disabled="disabled";}
                //loop through options
                for(var i=0;i<select_options.length;i++)
                {
                        var checked="";
                        var currOption = jQuery(select_options).get(i);
                        
                        if(i===0){
                                name =jQuery(currOption).text();
                        }
                        else
                        {
                                if(jQuery(currOption).attr("selected")){checked ="selected";}

                                opts_str = opts_str + "<li class=\""+checked +" "+disabled+"\"><span class=\"elmValue\">"+jQuery(currOption).val()+"</span>"+jQuery(currOption).text()+"</li>";
                        }
                }
                
                jQuery(wrapperElm).empty().html("<div class=\"selectbox\"><ul><li>"+name+"</li></ul></div><div class=\"selectboxoptions_wrap\"><ul class=\""+boxtype+"\">"+opts_str+"</ul></div>");
                jQuery(wrapperElm).find(selectboxoptions_wrap +" ul").after("<div class=\""+classselectboxfoot+"\"><div></div></div>"); //add footer
                
                if("auto" != opts.selectwidth){
                        jQuery(wrapperElm).find(selectbox + " ul").css({width:opts.selectwidth});
                        jQuery(wrapperElm).find(selectboxoptions_wrap + " ul").attr("class",boxtype).css({width:(opts.selectwidth+57) + "px"});
                        jQuery(wrapperElm).find(selectboxfoot + " div").css({width:opts.selectwidth + "px"});
                }else{
                        jQuery(wrapperElm).find(selectboxoptions_wrap + " ul").attr("class",boxtype).css({width:(jQuery(wrapperElm).find(selectbox + " ul").width()+57) + "px"});
                        jQuery(wrapperElm).find(selectboxfoot + " div").css({width:jQuery(wrapperElm).find(selectbox + " ul").width() + "px"});
                }

                if(isDisabled){jQuery.fn.disable(jQuery(wrapperElm).find(selectboxoptions_wrap));}
                
                var thisElement = jQuery(opts.wrappername);

                //bind item clicks
                jQuery(selectboxoptions_wrap+ " ul li").unbind().click( function() {
                        
                        if(jQuery(this).attr("class").indexOf("disabled") < 0)
                        {
                                var id;
                                var boxtype = jQuery(this).parent().attr("class");
                                
                                if(boxtype.indexOf("selectboxoptions_radio") >-1)
                                {
                                        if(!jQuery(this).hasClass(classselected))
                                        {
                                                id = jQuery(this).find(elmValue).text();
                                                jQuery(this).parent().find("." + classselected).removeClass(classselected);
                                                jQuery(this).addClass(classselected);
                                                jQuery(this).parent().parent().find("input").val(jQuery(this).find(elmValue).text());
                                        }
                                        else
                                        {
                                                jQuery(this).parent().find("." + classselected).removeClass(classselected);
                                                jQuery(this).parent().parent().find("input").val("");
                                        }
                                }
                                else //checkbox
                                {
                                        if(jQuery(this).hasClass(classselected))
                                        {
                                                //turn off the checkbox
                                                jQuery(this).removeClass(classselected);
                                                //blank out the value
                                                jQuery(this).find("input").val("");
                                        }
                                        else
                                        {
                                                //gets the value of the element
                                                id = jQuery(this).find(elmValue).text();        
                                                jQuery(this).addClass(classselected);
                                                jQuery(this).find("input").val(id);
                                        }
                                }
                        }
                }).hover(function(){
                        jQuery(this).addClass(opts.hoverstyle);
                },function(){
                        jQuery(this).removeClass(opts.hoverstyle);
                });

                //bind sliding open
                jQuery(thisElement).find(selectbox).unbind().toggle(
                        function() {
                                if(opts.isscrolling){jQuery.fn.scrolling(jQuery(this),true);}
                                //unhide li
                                jQuery(this).parent().find(selectboxoptions_wrap+ " ul li").removeClass(hideitem);
                                //makes the arrow go up or down
                                jQuery(this).removeClass(classselectbox).addClass(classselectboxopen);
                                //slides the options down
                                jQuery(this).parent().find(selectboxoptions_wrap).slideDown(opts.openspeed);
                        },
                        function() {
                                var boxtype = jQuery(this).parent().find(selectboxoptions_wrap+ " ul").attr("class");
                                if(jQuery(this).parent().find(selectboxoptions_wrap+ " ul li").hasClass(classselected))
                                {
                                        jQuery(this).parent().find(selectboxoptions_wrap+ " ul li").addClass(hideitem);
                                }       
                                else
                                {
                                        //makes the arrows go up or down
                                        jQuery(this).removeClass(classselectboxopen).addClass(classselectbox);
                                        //slides the options up
                                        jQuery(this).parent().find(selectboxoptions_wrap).slideUp("normal");
                                }
                                
                                if(opts.isscrolling){jQuery.fn.scrolling(jQuery(this),false);}
                        });
                
                        
                        jQuery.fn.addformelms(jQuery(wrapperElm));
                        if(opts.preopenselect){ jQuery.fn.openSelectBoxsThatArePrePopulated(jQuery(wrapperElm));}
                        if(opts.alldisabled){jQuery.fn.disable(jQuery(thisElement));}
                });
                
        };
        
})(jQuery);
