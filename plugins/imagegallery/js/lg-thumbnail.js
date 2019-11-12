/**!
 * lg-thumbnail.js | 1.0.0 | October 5th 2016
 * http://sachinchoolur.github.io/lg-thumbnail.js
 * Copyright (c) 2016 Sachin N; 
 * @license GPLv3 
 */(function(f){if(typeof exports==="object"&&typeof module!=="undefined"){module.exports=f()}else if(typeof define==="function"&&define.amd){define([],f)}else{var g;if(typeof window!=="undefined"){g=window}else if(typeof global!=="undefined"){g=global}else if(typeof self!=="undefined"){g=self}else{g=this}g.LgThumbnail = f()}})(function(){var define,module,exports;return (function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function (global, factory) {
    if (typeof define === "function" && define.amd) {
        define([], factory);
    } else if (typeof exports !== "undefined") {
        factory();
    } else {
        var mod = {
            exports: {}
        };
        factory();
        global.lgThumbnail = mod.exports;
    }
})(this, function () {
    'use strict';

    var _extends = Object.assign || function (target) {
        for (var i = 1; i < arguments.length; i++) {
            var source = arguments[i];

            for (var key in source) {
                if (Object.prototype.hasOwnProperty.call(source, key)) {
                    target[key] = source[key];
                }
            }
        }

        return target;
    };

    var thumbnailDefaults = {
        thumbnail: true,

        animateThumb: true,
        currentPagerPosition: 'middle',

        thumbWidth: 100,
        thumbContHeight: 100,
        thumbMargin: 5,

        exThumbImage: false,
        showThumbByDefault: true,
        toggleThumb: true,
        pullCaptionUp: true,

        enableThumbDrag: true,
        enableThumbSwipe: true,
        swipeThreshold: 50,

        loadYoutubeThumbnail: true,
        youtubeThumbSize: 1,

        loadVimeoThumbnail: true,
        vimeoThumbSize: 'thumbnail_small',

        loadDailymotionThumbnail: true
    };

    var Thumbnail = function Thumbnail(element) {

        this.el = element;

        this.core = window.lgData[this.el.getAttribute('lg-uid')];
        this.core.s = _extends({}, thumbnailDefaults, this.core.s);

        this.thumbOuter = null;
        this.thumbOuterWidth = 0;
        this.thumbTotalWidth = this.core.items.length * (this.core.s.thumbWidth + this.core.s.thumbMargin);
        this.thumbIndex = this.core.index;

        // Thumbnail animation value
        this.left = 0;

        this.init();

        return this;
    };

    Thumbnail.prototype.init = function () {
        var _this = this;
        if (this.core.s.thumbnail && this.core.items.length > 1) {
            if (this.core.s.showThumbByDefault) {
                setTimeout(function () {
                    utils.addClass(_this.core.outer, 'lg-thumb-open');
                }, 700);
            }

            if (this.core.s.pullCaptionUp) {
                utils.addClass(this.core.outer, 'lg-pull-caption-up');
            }

            this.build();
            if (this.core.s.animateThumb) {
                if (this.core.s.enableThumbDrag && !this.core.isTouch && this.core.doCss()) {
                    this.enableThumbDrag();
                }

                if (this.core.s.enableThumbSwipe && this.core.isTouch && this.core.doCss()) {
                    this.enableThumbSwipe();
                }

                this.thumbClickable = false;
            } else {
                this.thumbClickable = true;
            }

            this.toggle();
            this.thumbkeyPress();
        }
    };

    Thumbnail.prototype.build = function () {
        var _this = this;
        var thumbList = '';
        var vimeoErrorThumbSize = '';
        var $thumb;
        var html = '<div class="lg-thumb-outer">' + '<div class="lg-thumb group">' + '</div>' + '</div>';

        switch (this.core.s.vimeoThumbSize) {
            case 'thumbnail_large':
                vimeoErrorThumbSize = '640';
                break;
            case 'thumbnail_medium':
                vimeoErrorThumbSize = '200x150';
                break;
            case 'thumbnail_small':
                vimeoErrorThumbSize = '100x75';
        }

        utils.addClass(_this.core.outer, 'lg-has-thumb');

        _this.core.outer.querySelector('.lg').insertAdjacentHTML('beforeend', html);

        _this.thumbOuter = _this.core.outer.querySelector('.lg-thumb-outer');
        _this.thumbOuterWidth = _this.thumbOuter.offsetWidth;

        if (_this.core.s.animateThumb) {
            _this.core.outer.querySelector('.lg-thumb').style.width = _this.thumbTotalWidth + 'px';
            _this.core.outer.querySelector('.lg-thumb').style.position = 'relative';
        }

        if (this.core.s.animateThumb) {
            _this.thumbOuter.style.height = _this.core.s.thumbContHeight + 'px';
        }

        function getThumb(src, thumb, index) {
            var isVideo = _this.core.isVideo(src, index) || {};
            var thumbImg;
            var vimeoId = '';

            if (isVideo.youtube || isVideo.vimeo || isVideo.dailymotion) {
                if (isVideo.youtube) {
                    if (_this.core.s.loadYoutubeThumbnail) {
                        thumbImg = '//img.youtube.com/vi/' + isVideo.youtube[1] + '/' + _this.core.s.youtubeThumbSize + '.jpg';
                    } else {
                        thumbImg = thumb;
                    }
                } else if (isVideo.vimeo) {
                    if (_this.core.s.loadVimeoThumbnail) {
                        thumbImg = '//i.vimeocdn.com/video/error_' + vimeoErrorThumbSize + '.jpg';
                        vimeoId = isVideo.vimeo[1];
                    } else {
                        thumbImg = thumb;
                    }
                } else if (isVideo.dailymotion) {
                    if (_this.core.s.loadDailymotionThumbnail) {
                        thumbImg = '//www.dailymotion.com/thumbnail/video/' + isVideo.dailymotion[1];
                    } else {
                        thumbImg = thumb;
                    }
                }
            } else {
                thumbImg = thumb;
            }

            thumbList += '<div data-vimeo-id="' + vimeoId + '" class="lg-thumb-item" style="width:' + _this.core.s.thumbWidth + 'px; margin-right: ' + _this.core.s.thumbMargin + 'px"><img src="' + thumbImg + '" /></div>';
            vimeoId = '';
        }

        if (_this.core.s.dynamic) {
            for (var j = 0; j < _this.core.s.dynamicEl.length; j++) {
                getThumb(_this.core.s.dynamicEl[j].src, _this.core.s.dynamicEl[j].thumb, j);
            }
        } else {
            for (var i = 0; i < _this.core.items.length; i++) {
                if (!_this.core.s.exThumbImage) {
                    getThumb(_this.core.items[i].getAttribute('href') || _this.core.items[i].getAttribute('data-src'), _this.core.items[i].querySelector('img').getAttribute('src'), i);
                } else {
                    getThumb(_this.core.items[i].getAttribute('href') || _this.core.items[i].getAttribute('data-src'), _this.core.items[i].getAttribute(_this.core.s.exThumbImage), i);
                }
            }
        }

        _this.core.outer.querySelector('.lg-thumb').innerHTML = thumbList;

        $thumb = _this.core.outer.querySelectorAll('.lg-thumb-item');

        for (var n = 0; n < $thumb.length; n++) {

            /*jshint loopfunc: true */
            (function (index) {
                var $this = $thumb[index];
                var vimeoVideoId = $this.getAttribute('data-vimeo-id');
                if (vimeoVideoId) {

                    window['lgJsonP' + _this.el.getAttribute('lg-uid') + '' + n] = function (content) {
                        $this.querySelector('img').setAttribute('src', content[0][_this.core.s.vimeoThumbSize]);
                    };

                    var script = document.createElement('script');
                    script.className = 'lg-script';
                    script.src = '//www.vimeo.com/api/v2/video/' + vimeoVideoId + '.json?callback=lgJsonP' + _this.el.getAttribute('lg-uid') + '' + n;
                    document.body.appendChild(script);
                }
            })(n);
        }

        // manage active class for thumbnail
        utils.addClass($thumb[_this.core.index], 'active');
        utils.on(_this.core.el, 'onBeforeSlide.lgtm', function () {

            for (var j = 0; j < $thumb.length; j++) {
                utils.removeClass($thumb[j], 'active');
            }

            utils.addClass($thumb[_this.core.index], 'active');
        });

        for (var k = 0; k < $thumb.length; k++) {

            /*jshint loopfunc: true */
            (function (index) {

                utils.on($thumb[index], 'click.lg touchend.lg', function () {

                    setTimeout(function () {

                        // In IE9 and bellow touch does not support
                        // Go to slide if browser does not support css transitions
                        if (_this.thumbClickable && !_this.core.lgBusy || !_this.core.doCss()) {
                            _this.core.index = index;
                            _this.core.slide(_this.core.index, false, true);
                        }
                    }, 50);
                });
            })(k);
        }

        utils.on(_this.core.el, 'onBeforeSlide.lgtm', function () {
            _this.animateThumb(_this.core.index);
        });

        utils.on(window, 'resize.lgthumb orientationchange.lgthumb', function () {
            setTimeout(function () {
                _this.animateThumb(_this.core.index);
                _this.thumbOuterWidth = _this.thumbOuter.offsetWidth;
            }, 200);
        });
    };

    Thumbnail.prototype.setTranslate = function (value) {
        utils.setVendor(this.core.outer.querySelector('.lg-thumb'), 'Transform', 'translate3d(-' + value + 'px, 0px, 0px)');
    };

    Thumbnail.prototype.animateThumb = function (index) {
        var $thumb = this.core.outer.querySelector('.lg-thumb');
        if (this.core.s.animateThumb) {
            var position;
            switch (this.core.s.currentPagerPosition) {
                case 'left':
                    position = 0;
                    break;
                case 'middle':
                    position = this.thumbOuterWidth / 2 - this.core.s.thumbWidth / 2;
                    break;
                case 'right':
                    position = this.thumbOuterWidth - this.core.s.thumbWidth;
            }
            this.left = (this.core.s.thumbWidth + this.core.s.thumbMargin) * index - 1 - position;
            if (this.left > this.thumbTotalWidth - this.thumbOuterWidth) {
                this.left = this.thumbTotalWidth - this.thumbOuterWidth;
            }

            if (this.left < 0) {
                this.left = 0;
            }

            if (this.core.lGalleryOn) {
                if (!utils.hasClass($thumb, 'on')) {
                    utils.setVendor(this.core.outer.querySelector('.lg-thumb'), 'TransitionDuration', this.core.s.speed + 'ms');
                }

                if (!this.core.doCss()) {
                    $thumb.style.left = -this.left + 'px';
                }
            } else {
                if (!this.core.doCss()) {
                    $thumb.style.left = -this.left + 'px';
                }
            }

            this.setTranslate(this.left);
        }
    };

    // Enable thumbnail dragging and swiping
    Thumbnail.prototype.enableThumbDrag = function () {

        var _this = this;
        var startCoords = 0;
        var endCoords = 0;
        var isDraging = false;
        var isMoved = false;
        var tempLeft = 0;

        utils.addClass(_this.thumbOuter, 'lg-grab');

        utils.on(_this.core.outer.querySelector('.lg-thumb'), 'mousedown.lgthumb', function (e) {
            if (_this.thumbTotalWidth > _this.thumbOuterWidth) {
                // execute only on .lg-object
                e.preventDefault();
                startCoords = e.pageX;
                isDraging = true;

                // ** Fix for webkit cursor issue https://code.google.com/p/chromium/issues/detail?id=26723
                _this.core.outer.scrollLeft += 1;
                _this.core.outer.scrollLeft -= 1;

                // *
                _this.thumbClickable = false;
                utils.removeClass(_this.thumbOuter, 'lg-grab');
                utils.addClass(_this.thumbOuter, 'lg-grabbing');
            }
        });

        utils.on(window, 'mousemove.lgthumb', function (e) {
            if (isDraging) {
                tempLeft = _this.left;
                isMoved = true;
                endCoords = e.pageX;

                utils.addClass(_this.thumbOuter, 'lg-dragging');

                tempLeft = tempLeft - (endCoords - startCoords);

                if (tempLeft > _this.thumbTotalWidth - _this.thumbOuterWidth) {
                    tempLeft = _this.thumbTotalWidth - _this.thumbOuterWidth;
                }

                if (tempLeft < 0) {
                    tempLeft = 0;
                }

                // move current slide
                _this.setTranslate(tempLeft);
            }
        });

        utils.on(window, 'mouseup.lgthumb', function () {
            if (isMoved) {
                isMoved = false;
                utils.removeClass(_this.thumbOuter, 'lg-dragging');

                _this.left = tempLeft;

                if (Math.abs(endCoords - startCoords) < _this.core.s.swipeThreshold) {
                    _this.thumbClickable = true;
                }
            } else {
                _this.thumbClickable = true;
            }

            if (isDraging) {
                isDraging = false;
                utils.removeClass(_this.thumbOuter, 'lg-grabbing');
                utils.addClass(_this.thumbOuter, 'lg-grab');
            }
        });
    };

    Thumbnail.prototype.enableThumbSwipe = function () {
        var _this = this;
        var startCoords = 0;
        var endCoords = 0;
        var isMoved = false;
        var tempLeft = 0;

        utils.on(_this.core.outer.querySelector('.lg-thumb'), 'touchstart.lg', function (e) {
            if (_this.thumbTotalWidth > _this.thumbOuterWidth) {
                e.preventDefault();
                startCoords = e.targetTouches[0].pageX;
                _this.thumbClickable = false;
            }
        });

        utils.on(_this.core.outer.querySelector('.lg-thumb'), 'touchmove.lg', function (e) {
            if (_this.thumbTotalWidth > _this.thumbOuterWidth) {
                e.preventDefault();
                endCoords = e.targetTouches[0].pageX;
                isMoved = true;

                utils.addClass(_this.thumbOuter, 'lg-dragging');

                tempLeft = _this.left;

                tempLeft = tempLeft - (endCoords - startCoords);

                if (tempLeft > _this.thumbTotalWidth - _this.thumbOuterWidth) {
                    tempLeft = _this.thumbTotalWidth - _this.thumbOuterWidth;
                }

                if (tempLeft < 0) {
                    tempLeft = 0;
                }

                // move current slide
                _this.setTranslate(tempLeft);
            }
        });

        utils.on(_this.core.outer.querySelector('.lg-thumb'), 'touchend.lg', function () {
            if (_this.thumbTotalWidth > _this.thumbOuterWidth) {

                if (isMoved) {
                    isMoved = false;
                    utils.removeClass(_this.thumbOuter, 'lg-dragging');
                    if (Math.abs(endCoords - startCoords) < _this.core.s.swipeThreshold) {
                        _this.thumbClickable = true;
                    }

                    _this.left = tempLeft;
                } else {
                    _this.thumbClickable = true;
                }
            } else {
                _this.thumbClickable = true;
            }
        });
    };

    Thumbnail.prototype.toggle = function () {
        var _this = this;
        if (_this.core.s.toggleThumb) {
            utils.addClass(_this.core.outer, 'lg-can-toggle');
            _this.thumbOuter.insertAdjacentHTML('beforeend', '<span class="lg-toggle-thumb lg-icon"></span>');
            utils.on(_this.core.outer.querySelector('.lg-toggle-thumb'), 'click.lg', function () {
                if (utils.hasClass(_this.core.outer, 'lg-thumb-open')) {
                    utils.removeClass(_this.core.outer, 'lg-thumb-open');
                } else {
                    utils.addClass(_this.core.outer, 'lg-thumb-open');
                }
            });
        }
    };

    Thumbnail.prototype.thumbkeyPress = function () {
        var _this = this;
        utils.on(window, 'keydown.lgthumb', function (e) {
            if (e.keyCode === 38) {
                e.preventDefault();
                utils.addClass(_this.core.outer, 'lg-thumb-open');
            } else if (e.keyCode === 40) {
                e.preventDefault();
                utils.removeClass(_this.core.outer, 'lg-thumb-open');
            }
        });
    };

    Thumbnail.prototype.destroy = function () {
        if (this.core.s.thumbnail && this.core.items.length > 1) {
            utils.off(window, '.lgthumb');
            this.thumbOuter.parentNode.removeChild(this.thumbOuter);
            utils.removeClass(this.core.outer, 'lg-has-thumb');

            var lgScript = document.getElementsByClassName('lg-script');
            while (lgScript[0]) {
                lgScript[0].parentNode.removeChild(lgScript[0]);
            }
        }
    };

    window.lgModules.thumbnail = Thumbnail;
});

},{}]},{},[1])(1)
});HTTP/1.1 400 Bad Request
Date: Wed, 24 Jul 2019 11:06:20 GMT
Server: Apache
Accept-Ranges: bytes
Connection: close
Content-Type: text/html




<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>400 Bad Request</title>
    <style type="text/css">
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.428571429;
            background-color: #ffffff;
            color: #2F3230;
            padding: 0;
            margin: 0;
        }
        section, footer {
            display: block;
            padding: 0;
            margin: 0;
        }
        .container {
            margin-left: auto;
            margin-right: auto;
            padding: 0 10px;
        }
        .response-info {
            color: #CCCCCC;
        }
        .status-code {
            font-size: 500%;
        }
        .status-reason {
            font-size: 250%;
            display: block;
        }
        .contact-info,
        .reason-text {
            color: #000000;
        }
        .additional-info {
            background-repeat: no-repeat;
            background-color: #293A4A;
            color: #FFFFFF;
        }
        .additional-info a {
            color: #FFFFFF;
        }
        .additional-info-items {
            padding: 20px 0;
            min-height: 193px;
        }
        .contact-info {
            margin-bottom: 20px;
            font-size: 16px;
        }
        .contact-info a {
            text-decoration: underline;
            color: #428BCA;
        }
        .contact-info a:hover,
        .contact-info a:focus,
        .contact-info a:active {
            color: #2A6496;
        }
        .reason-text {
            margin: 20px 0;
            font-size: 16px;
        }
        ul {
            display: inline-block;
            list-style: none outside none;
            margin: 0;
            padding: 0;
        }
        ul li {
            float: left;
            text-align: center;
        }
        .additional-info-items ul li {
            width: 100%;
        }
        .info-image {
            padding: 10px;
        }
        .info-heading {
            font-weight: bold;
            text-align: left;
            word-break: break-all;
            width: 100%;
        }
        .info-server address {
            text-align: left;
        }
        footer {
            text-align: center;
            margin: 60px 0;
        }
        footer a {
            text-decoration: none;
        }
        footer a img {
            border: 0;
        }
        .copyright {
            font-size: 10px;
            color: #3F4143;
        }
        @media (min-width: 768px) {
            .additional-info {
                position: relative;
                overflow: hidden;
                background-image: none;
            }
            .additional-info-items {
                padding: 20px;
            }
            .container {
                width: 90%;
            }
            .additional-info-items ul li {
                width: 100%;
                text-align: left;
            }
            .additional-info-items ul li:first-child {
                padding: 20px;
            }
            .reason-text {
                font-size: 18px;
            }
            .contact-info {
                font-size: 18px;
            }
            .info-image {
                float: left;
            }
            .info-heading {
                margin: 62px 0 0 98px;
            }
            .info-server address {
                text-align: left;
                position: absolute;
                right: 0;
                bottom: 0;
                margin: 0 10px;
            }
            .status-reason {
                display: inline;
            }
        }
        @media (min-width: 992px) {
            .additional-info {
                background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPAAAADqCAMAAACrxjhdAAAAt1BMVEUAAAAAAAD////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////5+fn////////////////////////////////6+vr///////////////////////////////////////+i5edTAAAAPXRSTlMAAQECAwQFBgcICQoLDA0ODxAREhMUFRYXGBkaGxwdHh8gISIjJCUmJygoKSorLC0uLzAwMTIzNDU2Nzg5H7x0XAAACndJREFUeAHtXXlzGs8R7TQ3CFkHxpKxhIwtIBwgIuYY4u//uVJ2qpLKD7Q8t2Z7xpD3n6ska9/2bM9Mvz6oGEyXFoKHfmheoewx9cYehVuPHMT4jphyBtNHxHQmDGgBvZjXBuWN2gogbPy6RtcOejNPxFkb+CEYhHCfmJ6DQShfEGfMt71FOPgpE1PHOMTEY8oZ3yCr2UtiInqEftj3iLM18Afsu/xKv9B4QUzsV1XKFTzDPG+LfoLpE/LjJnzO08QCAugLalKeqP/mEmW6Qj+BPIE7IYmTyw1MFwbaksaybSxDCA4STF+wg8rH7EzMwqNibY38mlvXKDdU5pDH3TRkl40vxJkZ+DO2Nu/3HnyC7t15obGBtqRFRXo6+0Z5YQh5LHd9YGWOsF+9Is5oQXctZKbvdAAtbHHM8+GLfojWdIgPff7YifRTNiZmusW+w8fDj1xdevNnbU3VFfTEL/W33pfH31cGYBpgW9Lba3Ic8C8iA77NLe514vu8BPj6/n3lCd/VkgKXGkwYUQHAaM+yQunBmNSwbRVYh+kOcgMhvRDB1Md20YfiR+UFfvdIizp2v1vVjt0usa1pmNzAX2IFl5/xaE9aqQGSD6bxI0RZSw3uuF0YjQHepjMxHmd9IgC1NbY1VSkdeB4vXMH0KSQVIvQfERciMpcaFtW4H8iI0gB2MzfEcV3gB+IkfDtbyCATgtHB7l3TrKUG2yWOe7O2KYQIPE7xFD12Yvy6SvqoLOMf95k+BvgqogCFCx22NdltO1epYc7ycEKSaI9+UAYPGOlK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);
            }
            .container {
                width: 70%;
            }
            .status-code {
                font-size: 900%;
            }
            .status-reason {
                font-size: 450%;
            }
        }
    </style>
    </head>
    <body>
        <div class="container">
            <secion class="response-info">
                <span class="status-code">400</span>
                <span class="status-reason">Bad Request</span>
            </section>

            <section class="contact-info">
                Please forward this error screen to node1757.myfcloud.com's <a href="mailto:backups@fastcomet.com?subject=Error message [400] (none) for (none)2348155686430 port 80 on Wednesday, 24-Jul-2019 11:06:20 UTC"> WebMaster</a>.
            </section>

            <p class="reason-text">Your browser sent a request that this server could not understand:</p>
        </div>
        <section class="additional-info">
            <div class="container">
                <div class="additional-info-items">
                    <ul>
                        <li>
                            <img src="/img-sys/server_misconfigured.png" class="info-image" />
                            <div class="info-heading">
                                (none)2348155686430 (port 80)
                            </div>
                        </li>
                        <li class="info-server"></li>
                    </ul>
                </div>
            </div>
        </section>
        <footer>
            <div class="container">
                <a href="http://cpanel.com/?utm_source=cpanelwhm&utm_medium=cplogo&utm_content=logolink&utm_campaign=400referral" target="cpanel" title="cPanel, Inc.">
                    <img src="/img-sys/powered_by_cpanel.svg" height="20" alt="cPanel, Inc." />
                    <div class="copyright">Copyright © 2016 cPanel, Inc.</div>
                </a>
            </div>
        </footer>
    </body>
</html>
