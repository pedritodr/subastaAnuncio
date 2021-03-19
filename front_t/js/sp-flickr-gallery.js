(function(document,$){"use strict";var spflickrPhotoStream=function($el,options){if(options.setid){var url=['http://api.flickr.com/services/feeds/photoset.gne?set='+options.setid+'&nsid='+options.id+'&format=json&jsoncallback=?'].join('');}return $.getJSON(url).done(function(data){for(var i=0;i<options.count;i=i+1){var pic=data.items[i];var picsrc=(pic.media.m).replace("_m.jpg","_s.jpg");$("<img class='img-responsive' alt='"+pic.title+"' />").attr("src",picsrc).appendTo($el).wrap(options.container||'').wrap(['<a target="_blank" href="'+pic.link+'" title="'+pic.title+'"><span class="flickr-gallery-wrap"></span></a>'].join(''));}});};$.fn.spflickrPhotoStream=function(options){return spflickrPhotoStream($(this).get(),options||{});};$(document).ready(function(){$('.sp-flickr-gallery').each(function(){var $this=$(this);$this.spflickrPhotoStream({id:$this.data('id'),setid:$this.data('setid'),count:$this.data('count'),container:'<li />'});});});})(document,jQuery);