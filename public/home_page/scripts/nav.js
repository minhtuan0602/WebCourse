var _Nav = {
	_TopPercent : 10,

	Init : function(nav_data){
		$('#navbar').css("height", _NAVBARHEIGHT);
		$('#navbar').css("line-height", _NAVBARHEIGHT + 'px');
		var html = '<div class="navp">';
		for (var i = 0; i < nav_data.length; i++) {
			html += '<div class="navc">' + nav_data[i].toUpperCase() + '</div>';
			if (i != nav_data.length - 1){
				html += '<div class="navdot"></div>';	
			}
		}
		html += '</div>';
		$('#navbar').append(html);

		var NavBarLi = $('.navc');
		for (var i = 0; i < NavBarLi.length; i++) {
			NavBarLi[i].addEventListener("click", ScrollToPosition, false);
			NavBarLi[i].position = i;	
		};
	},

	RePosition : function(){
		var ScrollTop = $(document).scrollTop();
		var position = Math.floor(ScrollTop / _WinInsideHeight);
		if (position != 0) {
			$('#navbar').css("top", 0);
			return;
		}
		var mod = ScrollTop % _WinInsideHeight;
		var Percent = (_WinInsideHeight - mod) / _WinInsideHeight;
		var TopNav = _WinHeight * this._TopPercent / 100 * Percent;
		$('#navbar').css("top", TopNav);	
	}, 

	onWindowResize : function(){
		this.RePosition();	
	}
};