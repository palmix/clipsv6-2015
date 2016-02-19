var firstparallaxslider=new parallaxSlider({
wrapperid: 'myparallaxslider', //ID of DIV on page to house slider
displaymode: {type:'auto', pause:3000, cycles:100, stoponclick:false, pauseonmouseover:true},
delaybtwdesc: 500, // delay in milliseconds between the revealing of each description layer inside a slide
navbuttons: ['http://www.dynamicdrive.com/dynamicindex17/parallaxslider/left.png', 'http://www.dynamicdrive.com/dynamicindex17/parallaxslider/right.png', 'http://www.dynamicdrive.com/dynamicindex17/parallaxslider/up.png', 'http://www.dynamicdrive.com/dynamicindex17/parallaxslider/down.png'], // path to nav images
activeslideclass: 'selectedslide', // CSS class that gets added to currently shown DIV slide
orientation: 'v', //Valid values: "h" or "v"
persist: true, //remember last viewed slide and recall within same session?
slideduration: 1000 //transition duration (milliseconds)
})

  function recent(json) {document.write(''); for (var i = 0; i < numposts; i++) {var entry = json.feed.entry[i];var posturl;if (i == json.feed.entry.length) break;for (var k = 0; k < entry.link.length;k++){
if(entry.link[k].rel=='replies'&&entry.link[k].type=='text/html'){var commenttext=entry.link[k].title;var commenturl=entry.link[k].href;}
if (entry.link[k].rel == 'alternate') {var posttitle = entry.title.$t; posturl = entry.link[k].href;break;}}var thumburl;try {thumburl=entry.media.url;}catch (error)



{
s=entry.content.$t;a=s.indexOf("<img");b=s.indexOf("src=\"",a);c=s.indexOf("\"",b+5);d=s.substr(b+5,c-b-5);if((a!=-1)&&(b!=-1)&&(c!=-1)&&(d!="")){
thumburl=d;} else thumburl='http://1.bp.blogspot.com/-CFcOcKSvTBw/VMMYipUZBxI/AAAAAAAADSM/hgbdjdVjNeY/s1600/.png';
}


document.write('');
if(showpostthumbnails==true) 
document.write('<div class="slide">');
   

var towrite='';var flag=0;
document.write('<a href="'+posturl+'" target="_top"><div class="bgoverlay" data-bgimage="'+thumburl+'?imgmax=250" title="'+posttitle+'" alt="'+posttitle+'"></div><div class="desc"><div class="ccsmyparallaxslider" target="_top" href="'+posturl+'" dir="rtl" >'+posttitle+'</div>');
document.write('</a>'+'</div>');
document.write('</div>');

}

}
