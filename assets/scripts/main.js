/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {
    // Use this variable to set up the common and page specific functions. If you
    // rename this variable, you will also need to rename the namespace below.
    var Sage = {
        // All pages
        common: {
            init: function() {
                // JavaScript to be fired on all pages
            },
            finalize: function() {
                // JavaScript to be fired on all pages, after page specific JS is fired
            }
        },
        // Home page
        home: {
            init: function() {
                // JavaScript to be fired on the home page
            },
            finalize: function() {
                // JavaScript to be fired on the home page, after the init JS
            }
        },
        // About us page, note the change from about-us to about_us.
        about_us: {
            init: function() {
                // JavaScript to be fired on the about us page
            }
        }
    };

    // The routing fires all common scripts, followed by the page specific scripts.
    // Add additional events for more control over timing e.g. a finalize event
    var UTIL = {
        fire: function(func, funcname, args) {
            var fire;
            var namespace = Sage;
            funcname = funcname === undefined ? "init" : funcname;
            fire = func !== "";
            fire = fire && namespace[func];
            fire = fire && typeof namespace[func][funcname] === "function";

            if (fire) {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function() {
            // Fire common init JS
            UTIL.fire("common");

            // Fire page-specific init JS, and then finalize JS
            $.each(document.body.className.replace(/-/g, "_").split(/\s+/), function(i, classnm) {
                UTIL.fire(classnm);
                UTIL.fire(classnm, "finalize");
            });

            // Fire common finalize JS
            UTIL.fire("common", "finalize");
        }
    };

    // Load Events
    $(document).ready(UTIL.loadEvents);
})(jQuery); // Fully reference jQuery after this point.

$(document).foundation();

$(document).ready(function() {});

//photoswipe things
var initPhotoSwipeFromDOM = function(gallerySelector) {
    // parse slide data (url, title, size ...) from DOM elements
    // (children of gallerySelector)
    var parseThumbnailElements = function(el) {
        var thumbElements = el.childNodes,
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item;

        for (var i = 0; i < numNodes; i++) {
            figureEl = thumbElements[i]; // <figure> element

            // include only element nodes
            if (figureEl.nodeType !== 1) {
                continue;
            }

            linkEl = figureEl.children[0]; // <a> element

            size = linkEl.getAttribute("data-size").split("x");

            // create slide object
            item = {
                src: linkEl.getAttribute("href"),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
            };

            if (linkEl.getAttribute("data-title")) {
                item.title = "<h3>" + linkEl.getAttribute("data-title") + "</h3>";
                item.caption = linkEl.getAttribute("data-caption");
            } else {
                item.title = "";
            }

            if (figureEl.children.length > 1) {
                item.title = "<h3>" + figureEl.children[1].innerHTML + "</h3>";
            }

            if (linkEl.children.length > 0) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.children[0].getAttribute("src");
            }

            item.el = figureEl; // save link to element for getThumbBoundsFn
            items.push(item);
        }

        return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
        return el && (fn(el) ? el : closest(el.parentNode, fn));
    };

    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
        var pswpElement = document.querySelectorAll(".pswp")[0],
            gallery,
            options,
            items;

        items = parseThumbnailElements(galleryElement);

        // define options (if needed)
        options = {
            // define gallery index (for URL)
            galleryUID: galleryElement.getAttribute("data-pswp-uid"),

            getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el.getElementsByTagName("img")[0], // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect();

                return { x: rect.left, y: rect.top + pageYScroll, w: rect.width };
            }
        };

        // PhotoSwipe opened from URL
        if (fromURL) {
            if (options.galleryPIDs) {
                // parse real index when custom PIDs are used
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for (var j = 0; j < items.length; j++) {
                    if (items[j].pid === index) {
                        options.index = j;
                        break;
                    }
                }
            } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1;
            }
        } else {
            options.index = parseInt(index, 10);
        }

        // exit if index not found
        if (isNaN(options.index)) {
            return;
        }

        if (disableAnimation) {
            options.showAnimationDuration = 0;
        }

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };

    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
        e = e || window.event;
        // e.preventDefault ? e.preventDefault() : e.returnValue = false;
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }
        var eTarget = e.target || e.srcElement;

        // find root element of slide
        var clickedListItem = closest(eTarget, function(el) {
            return el.tagName && el.tagName.toUpperCase() === "FIGURE";
        });

        if (!clickedListItem) {
            return;
        }

        // find index of clicked item by looping through all child nodes
        // alternatively, you may define index via data- attribute
        var clickedGallery = clickedListItem.parentNode,
            childNodes = clickedListItem.parentNode.childNodes,
            numChildNodes = childNodes.length,
            nodeIndex = 0,
            index;

        for (var i = 0; i < numChildNodes; i++) {
            if (childNodes[i].nodeType !== 1) {
                continue;
            }

            if (childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
            }
            nodeIndex++;
        }

        if (index >= 0) {
            // open PhotoSwipe if valid index found
            openPhotoSwipe(index, clickedGallery);
        }
        return false;
    };

    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function() {
        var hash = window.location.hash.substring(1),
            params = {};

        if (hash.length < 5) {
            return params;
        }

        var vars = hash.split("&");
        for (var i = 0; i < vars.length; i++) {
            if (!vars[i]) {
                continue;
            }
            var pair = vars[i].split("=");
            if (pair.length < 2) {
                continue;
            }
            params[pair[0]] = pair[1];
        }

        if (params.gid) {
            params.gid = parseInt(params.gid, 10);
        }

        return params;
    };

    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll(gallerySelector);

    for (var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute("data-pswp-uid", i + 1);
        galleryElements[i].onclick = onThumbnailsClick;
    }

    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if (hashData.pid && hashData.gid) {
        openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
    }
};

// execute above function
if ($(".psgallery").length) {
    initPhotoSwipeFromDOM(".psgallery");
}

var initPhotoSwipeInline = function(gallerySelector) {
    // parse slide data (url, title, size ...) from DOM elements
    // (children of gallerySelector)
    var parseThumbnailElements = function(el) {
        var thumbElements = el.childNodes,
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item;

        //elejĂŠre egy preloader
        items.push({
            src: "../../wp-content/themes/brick/dist/images/preloader.gif",
            w: 20,
            h: 20
        });

        for (var i = 0; i < numNodes; i++) {
            figureEl = thumbElements[i]; // <figure> element

            // include only element nodes
            if (figureEl.nodeType !== 1) {
                continue;
            }

            linkEl = figureEl.children[0]; // <a> element

            size = linkEl.getAttribute("data-size").split("x");

            // create slide object
            if (linkEl.getAttribute("data-type") === "video") {
                item = {
                    html: '<div class="wrapper">' + linkEl.getAttribute("data-video") + "</div>"
                };
            } else {
                item = {
                    src: linkEl.getAttribute("href"),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10)
                };
            }

            item.title = linkEl.getAttribute("data-title") + linkEl.getAttribute("data-caption");

            if (figureEl.children.length > 1) {
                // <figcaption> content
                item.title = figureEl.children[1].innerHTML;
            }

            if (linkEl.children.length > 0) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.children[0].getAttribute("src");
            }

            item.el = figureEl; // save link to element for getThumbBoundsFn
            items.push(item);
        }

        //vĂŠgĂŠre egy preloader
        items.push({
            src: "../../wp-content/themes/brick/dist/images/preloader.gif",
            w: 20,
            h: 20
        });

        return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
        return el && (fn(el) ? el : closest(el.parentNode, fn));
    };

    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
        var pswpElement = document.querySelectorAll(".pswp")[0],
            gallery,
            options,
            items;

        items = parseThumbnailElements(galleryElement);

        // define options (if needed)
        options = {
            modal: false,
            closeOnScroll: false,
            showHideOpacity: true,
            history: false,
            loop: false,
            fullscreenEl: false,
            // hideAnimationDuration:0,
            // showAnimationDuration:0,
            // define gallery index (for URL)
            galleryUID: galleryElement.getAttribute("data-pswp-uid"),

            getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var pswpscene = document.querySelectorAll(".inlinepswp")[0],
                    rect = pswpscene.getBoundingClientRect();

                return { x: rect.width / 2, y: rect.height / 2, w: 0 };
            }
        };

        // PhotoSwipe opened from URL
        if (fromURL) {
            if (options.galleryPIDs) {
                // parse real index when custom PIDs are used
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for (var j = 0; j < items.length; j++) {
                    if (items[j].pid === index) {
                        options.index = j;
                        break;
                    }
                }
            } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1 + 1;
            }
        } else {
            options.index = parseInt(index, 10) + 1;
        }

        // exit if index not found
        if (isNaN(options.index)) {
            return;
        }

        if (disableAnimation) {
            options.showAnimationDuration = 0;
        }

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();

        gallery.listen("beforeChange", function() {
            var currItem = $(gallery.currItem.container);
            $(".pswp__video").removeClass("active");
            var currItemIframe = currItem.find(".pswp__video").addClass("active");
            $(".pswp__video").each(function() {
                if (!$(this).hasClass("active")) {
                    $(this).attr("src", $(this).attr("src"));
                }
            });

            var curInd = gallery.getCurrentIndex();
            var nofItems = gallery.options.getNumItemsFn();

            if (curInd === 0) {
                console.log("elso");
                window.location.href = $(".portnav__prev").attr("href");
            } else if (curInd + 1 === nofItems) {
                window.location.href = $(".portnav__next").attr("href");
            }
        });

        gallery.listen("afterChange", function() {
            var curInd = gallery.getCurrentIndex();
            var nofItems = gallery.options.getNumItemsFn();
            console.log("After: " + curInd + "/" + nofItems);
        });

        gallery.listen("close", function() {
            $(".pswp__video").each(function() {
                $(this).attr("src", $(this).attr("src"));
            });
            //window.history.back();
        });
        gallery.listen("destroy", function() {
            window.location.href = "../";
        });
    };

    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
        e = e || window.event;
        // e.preventDefault ? e.preventDefault() : e.returnValue = false;
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }
        var eTarget = e.target || e.srcElement;

        // find root element of slide
        var clickedListItem = closest(eTarget, function(el) {
            return el.tagName && el.tagName.toUpperCase() === "FIGURE";
        });

        if (!clickedListItem) {
            return;
        }

        // find index of clicked item by looping through all child nodes
        // alternatively, you may define index via data- attribute
        var clickedGallery = clickedListItem.parentNode,
            childNodes = clickedListItem.parentNode.childNodes,
            numChildNodes = childNodes.length,
            nodeIndex = 0,
            index;

        for (var i = 0; i < numChildNodes; i++) {
            if (childNodes[i].nodeType !== 1) {
                continue;
            }

            if (childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
            }
            nodeIndex++;
        }

        if (index >= 0) {
            // open PhotoSwipe if valid index found
            openPhotoSwipe(index, clickedGallery);
        }
        return false;
    };

    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function() {
        var hash = window.location.hash.substring(1),
            params = {
                gid: 1,
                pid: 1
            };

        if (hash.length < 5) {
            return params;
        }

        var vars = hash.split("&");
        for (var i = 0; i < vars.length; i++) {
            if (!vars[i]) {
                continue;
            }
            var pair = vars[i].split("=");
            if (pair.length < 2) {
                continue;
            }
            params[pair[0]] = pair[1];
        }

        if (params.gid) {
            params.gid = parseInt(params.gid, 10);
        }

        return params;
    };

    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll(gallerySelector);

    for (var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute("data-pswp-uid", i + 1);
        galleryElements[i].onclick = onThumbnailsClick;
    }

    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if (hashData.pid && hashData.gid) {
        openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
    }
    // else {
    //     if (galleryElements.length) {
    //         openPhotoSwipe( 1 ,  galleryElements[0], true, true );
    //     }
    // }
};

if ($(".psinlinegallery").length) {
    initPhotoSwipeInline(".psinlinegallery");
}

$(".js-togglecensoroverlay").on("click", function(e) {
    e.preventDefault();
    $(this)
        .closest(".censoroverlay")
        .addClass("turned-off");
    $(this)
        .closest(".censoroverlay")
        .remove();
});

/*** CONTACT FORM ******/
$("#contact_form").on("submit", function(ev, frm) {
    ev.preventDefault();
    //alert("elcsipve");

    //get input field values
    var user_name = $("input[name=message_name]").val();
    var user_email = $("input[name=message_email]").val();
    var user_tel = $("input[name=message_tel]").val();
    var user_msg = $("textarea[name=message_text]").val();

    var user_topic= '';
    var user_topicarray = [];
    $.each($('input[name="message_topic[]"]:checked'), function(){
        user_topicarray.push($(this).val());
    });
    user_topic+=user_topicarray.join(' | ');

    var proceed = true;
    if (user_name === "") {
        proceed = false;
    }
    if (user_email === "") {
        proceed = false;
    }

    if (user_tel === "") {
        proceed = false;
    }

    // if ($("input:checkbox[name=accept]:checked").length < 1) {
    //     proceed = false;
    // }

    //everything looks good! proceed...
    if (proceed) {
        //data to be sent to server
        var post_data = {
            userName: user_name,
            userEmail: user_email,
            userTel: user_tel,
            userTopic: user_topic,
            userMsg: user_msg
        };
        $("#contact_submit").addClass("disabled");
        $("#contact_submit").attr("disabled", "disabled");
        $("#contact_submit").text("Sending message...");

        //Ajax post data to server
        $.post(
            $("#contact_form").attr("action"),
            post_data,
            function(response) {
                var output = "";

                //load json data from server and output message
                if (response.type === "error") {
                    output = '<p class="error">' + response.text + "</p>";
                } else {
                    output = '<p class="success">' + response.text + "</p>";
                    window.dataLayer = window.dataLayer || [];
                    window.dataLayer.push({
                    'event': 'msgSent'
                    });

                    //reset values in all input fields
                    $("#contact_form input").val("");
                    $("#contact_form textarea").val("");
                }
                $("#result")
                    .hide()
                    .html(output)
                    .slideDown();
                $("#contact_submit").removeClass("disabled");
                $("#contact_submit").removeAttr("disabled");
                $("#contact_submit").text("Send a request");
            },
            "json"
        );
    }

    return false;
});

//reset previously set border colors and hide all message on .keyup()
$("#contact_form input, #contact_form textarea, #contact_form #accept").keyup(function() {
    //$("#contact_form input, #contact_form textarea").css('border-color', '');
    $("#result").slideUp();
    $("#formerror").slideUp();
});

$("#contact_form #accept").on("change", function() {
    $("#result").slideUp();
    $("#formerror").slideUp();
});
