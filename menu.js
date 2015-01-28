/**
 * jquery.dlmenu.js v1.0.1
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
;( function( $, window, undefined ) {

	&#39;use strict&#39;;

	// global
	var Modernizr = window.Modernizr, $body = $( &#39;body&#39; );

	$.DLMenu = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.DLMenu.defaults = {
		// classes for the animation effects
		animationClasses : { classin : &#39;dl-animate-in-1&#39;, classout : &#39;dl-animate-out-1&#39; },
		// callback: click a link that has a sub menu
		// el is the link element (li); name is the level name
		onLevelClick : function( el, name ) { return false; },
		// callback: click a link that does not have a sub menu
		// el is the link element (li); ev is the event obj
		onLinkClick : function( el, ev ) { return false; }
	};

	$.DLMenu.prototype = {
		_init : function( options ) {

			// options
			this.options = $.extend( true, {}, $.DLMenu.defaults, options );
			// cache some elements and initialize some variables
			this._config();
			
			var animEndEventNames = {
					&#39;WebkitAnimation&#39; : &#39;webkitAnimationEnd&#39;,
					&#39;OAnimation&#39; : &#39;oAnimationEnd&#39;,
					&#39;msAnimation&#39; : &#39;MSAnimationEnd&#39;,
					&#39;animation&#39; : &#39;animationend&#39;
				},
				transEndEventNames = {
					&#39;WebkitTransition&#39; : &#39;webkitTransitionEnd&#39;,
					&#39;MozTransition&#39; : &#39;transitionend&#39;,
					&#39;OTransition&#39; : &#39;oTransitionEnd&#39;,
					&#39;msTransition&#39; : &#39;MSTransitionEnd&#39;,
					&#39;transition&#39; : &#39;transitionend&#39;
				};
			// animation end event name
			this.animEndEventName = animEndEventNames[ Modernizr.prefixed( &#39;animation&#39; ) ] + &#39;.dlmenu&#39;;
			// transition end event name
			this.transEndEventName = transEndEventNames[ Modernizr.prefixed( &#39;transition&#39; ) ] + &#39;.dlmenu&#39;,
			// support for css animations and css transitions
			this.supportAnimations = Modernizr.cssanimations,
			this.supportTransitions = Modernizr.csstransitions;

			this._initEvents();

		},
		_config : function() {
			this.open = false;
			this.$trigger = this.$el.children( &#39;.dl-trigger&#39; );
			this.$menu = this.$el.children( &#39;ul.dl-menu&#39; );
			this.$menuitems = this.$menu.find( &#39;li:not(.dl-back)&#39; );
			this.$el.find( &#39;ul.dl-submenu&#39; ).prepend( &#39;&lt;li class=&quot;dl-back&quot;&gt;&lt;a href=&quot;#&quot;&gt;⁄Êœ… «·Ï «·Œ·›&lt;/a&gt;&lt;/li&gt;&#39; );
			this.$back = this.$menu.find( &#39;li.dl-back&#39; );
		},
		_initEvents : function() {

			var self = this;

			this.$trigger.on( &#39;click.dlmenu&#39;, function() {
				
				if( self.open ) {
					self._closeMenu();
				} 
				else {
					self._openMenu();
				}
				return false;

			} );

			this.$menuitems.on( &#39;click.dlmenu&#39;, function( event ) {
				
				event.stopPropagation();

				var $item = $(this),
					$submenu = $item.children( &#39;ul.dl-submenu&#39; );

				if( $submenu.length &gt; 0 ) {

					var $flyin = $submenu.clone().css( &#39;opacity&#39;, 0 ).insertAfter( self.$menu ),
						onAnimationEndFn = function() {
							self.$menu.off( self.animEndEventName ).removeClass( self.options.animationClasses.classout ).addClass( &#39;dl-subview&#39; );
							$item.addClass( &#39;dl-subviewopen&#39; ).parents( &#39;.dl-subviewopen:first&#39; ).removeClass( &#39;dl-subviewopen&#39; ).addClass( &#39;dl-subview&#39; );
							$flyin.remove();
						};

					setTimeout( function() {
						$flyin.addClass( self.options.animationClasses.classin );
						self.$menu.addClass( self.options.animationClasses.classout );
						if( self.supportAnimations ) {
							self.$menu.on( self.animEndEventName, onAnimationEndFn );
						}
						else {
							onAnimationEndFn.call();
						}

						self.options.onLevelClick( $item, $item.children( &#39;a:first&#39; ).text() );
					} );

					return false;

				}
				else {
					self.options.onLinkClick( $item, event );
				}

			} );

			this.$back.on( &#39;click.dlmenu&#39;, function( event ) {
				
				var $this = $( this ),
					$submenu = $this.parents( &#39;ul.dl-submenu:first&#39; ),
					$item = $submenu.parent(),

					$flyin = $submenu.clone().insertAfter( self.$menu );

				var onAnimationEndFn = function() {
					self.$menu.off( self.animEndEventName ).removeClass( self.options.animationClasses.classin );
					$flyin.remove();
				};

				setTimeout( function() {
					$flyin.addClass( self.options.animationClasses.classout );
					self.$menu.addClass( self.options.animationClasses.classin );
					if( self.supportAnimations ) {
						self.$menu.on( self.animEndEventName, onAnimationEndFn );
					}
					else {
						onAnimationEndFn.call();
					}

					$item.removeClass( &#39;dl-subviewopen&#39; );
					
					var $subview = $this.parents( &#39;.dl-subview:first&#39; );
					if( $subview.is( &#39;li&#39; ) ) {
						$subview.addClass( &#39;dl-subviewopen&#39; );
					}
					$subview.removeClass( &#39;dl-subview&#39; );
				} );

				return false;

			} );
			
		},
		closeMenu : function() {
			if( this.open ) {
				this._closeMenu();
			}
		},
		_closeMenu : function() {
			var self = this,
				onTransitionEndFn = function() {
					self.$menu.off( self.transEndEventName );
					self._resetMenu();
				};
			
			this.$menu.removeClass( &#39;dl-menuopen&#39; );
			this.$menu.addClass( &#39;dl-menu-toggle&#39; );
			this.$trigger.removeClass( &#39;dl-active&#39; );
			
			if( this.supportTransitions ) {
				this.$menu.on( this.transEndEventName, onTransitionEndFn );
			}
			else {
				onTransitionEndFn.call();
			}

			this.open = false;
		},
		openMenu : function() {
			if( !this.open ) {
				this._openMenu();
			}
		},
		_openMenu : function() {
			var self = this;
			// clicking somewhere else makes the menu close
			$body.off( &#39;click&#39; ).on( &#39;click.dlmenu&#39;, function() {
				self._closeMenu() ;
			} );
			this.$menu.addClass( &#39;dl-menuopen dl-menu-toggle&#39; ).on( this.transEndEventName, function() {
				$( this ).removeClass( &#39;dl-menu-toggle&#39; );
			} );
			this.$trigger.addClass( &#39;dl-active&#39; );
			this.open = true;
		},
		// resets the menu to its original state (first level of options)
		_resetMenu : function() {
			this.$menu.removeClass( &#39;dl-subview&#39; );
			this.$menuitems.removeClass( &#39;dl-subview dl-subviewopen&#39; );
		}
	};

	var logError = function( message ) {
		if ( window.console ) {
			window.console.error( message );
		}
	};

	$.fn.dlmenu = function( options ) {
		if ( typeof options === &#39;string&#39; ) {
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				var instance = $.data( this, &#39;dlmenu&#39; );
				if ( !instance ) {
					logError( &quot;cannot call methods on dlmenu prior to initialization; &quot; +
					&quot;attempted to call method &#39;&quot; + options + &quot;&#39;&quot; );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === &quot;_&quot; ) {
					logError( &quot;no such method &#39;&quot; + options + &quot;&#39; for dlmenu instance&quot; );
					return;
				}
				instance[ options ].apply( instance, args );
			});
		} 
		else {
			this.each(function() {	
				var instance = $.data( this, &#39;dlmenu&#39; );
				if ( instance ) {
					instance._init();
				}
				else {
					instance = $.data( this, &#39;dlmenu&#39;, new $.DLMenu( options, this ) );
				}
			});
		}
		return this;
	};

} )( jQuery, window );