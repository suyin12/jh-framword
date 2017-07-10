/*
Author: mg12
Update: 2008/05/05
Author URI: http://www.neoease.com/
*/
(function() {

function $(id) {
	return document.getElementById(id);
}

function setStyleDisplay(id, status) {
	$(id).style.display = status;
}


function switchTab(showPanels, hidePanels, activeTab, activeClass, fadeTab, fadeClass) {
	$(activeTab).className = activeClass;
	$(fadeTab).className = fadeClass;

	var panel, panelList;
	panelList = showPanels.split(',');
	for (var i = 0; i < panelList.length; i++) {
		var panel = panelList[i];
		if ($(panel)) {
			setStyleDisplay(panel, 'block');
		}
	}
	panelList = hidePanels.split(',');
	for (var i = 0; i < panelList.length; i++) {
		panel = panelList[i];
		if ($(panel)) {
			setStyleDisplay(panel, 'none');
		}
	}
}

function loadCommentShortcut() {
	$('comment').onkeydown = function (moz_ev) {
		var ev = null;
		if (window.event){
			ev = window.event;
		} else {
			ev = moz_ev;
		}
		if (ev != null && ev.ctrlKey && ev.keyCode == 13) {
			$('submit').click();
		}
	}
	$('submit').value += ' (Ctrl+Enter)';
}

function getElementsByClassName(className, tag, parent) {
	parent = parent || document;

	var allTags = (tag == '*' && parent.all) ? parent.all : parent.getElementsByTagName(tag);
	var matchingElements = new Array();

	className = className.replace(/\-/g, '\\-');
	var regex = new RegExp('(^|\\s)' + className + '(\\s|$)');

	var element;
	for (var i = 0; i < allTags.length; i++) {
		element = allTags[i];
		if (regex.test(element.className)) {
			matchingElements.push(element);
		}
	}

	return matchingElements;
}

window['MGJS'] = {};
window['MGJS']['$'] = $;
window['MGJS']['setStyleDisplay'] = setStyleDisplay;
window['MGJS']['switchTab'] = switchTab;
window['MGJS']['loadCommentShortcut'] = loadCommentShortcut;
window['MGJS']['getElementsByClassName'] = getElementsByClassName;

})();