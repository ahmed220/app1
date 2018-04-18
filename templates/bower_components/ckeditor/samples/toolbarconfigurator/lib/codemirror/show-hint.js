﻿(function(f){"object"==typeof exports&&"object"==typeof module?f(require("lib/codemirror")):"function"==typeof define&&define.amd?define(["lib/codemirror"],f):f(CodeMirror)})(function(f){function p(a,b){this.cm=a;this.options=this.buildOptions(b);this.widget=null;this.tick=this.debounce=0;this.startPos=this.cm.getCursor();this.startLen=this.cm.getLine(this.startPos.line).length;var c=this;a.on("cursorActivity",this.activityFunc=function(){c.cursorActivity()})}function w(a,b){function c(a,
c){var d;d="string"!=typeof c?function(a){return c(a,b)}:e.hasOwnProperty(c)?e[c]:c;f[a]=d}var e={Up:function(){b.moveFocus(-1)},Down:function(){b.moveFocus(1)},PageUp:function(){b.moveFocus(-b.menuSize()+1,!0)},PageDown:function(){b.moveFocus(b.menuSize()-1,!0)},Home:function(){b.setFocus(0)},End:function(){b.setFocus(b.length-1)},Enter:b.pick,Tab:b.pick,Esc:b.close},d=a.options.customKeys,f=d?{}:e;if(d)for(var g in d)d.hasOwnProperty(g)&&c(g,d[g]);if(d=a.options.extraKeys)for(g in d)d.hasOwnProperty(g)&&
c(g,d[g]);return f}function v(a,b){for(;b&&b!=a;){if("LI"===b.nodeName.toUpperCase()&&b.parentNode==a)return b;b=b.parentNode}}function n(a,b){this.completion=a;this.data=b;this.picked=!1;var c=this,e=a.cm,d=this.hints=document.createElement("ul");d.className="CodeMirror-hints";this.selectedHint=b.selectedHint||0;for(var m=b.list,g=0;g<m.length;++g){var l=d.appendChild(document.createElement("li")),h=m[g],k="CodeMirror-hint"+(g!=this.selectedHint?"":" CodeMirror-hint-active");null!=h.className&&(k=
h.className+" "+k);l.className=k;h.render?h.render(l,b,h):l.appendChild(document.createTextNode(h.displayText||("string"==typeof h?h:h.text)));l.hintId=g}var g=e.cursorCoords(a.options.alignWithWord?b.from:null),r=g.left,t=g.bottom,n=!0;d.style.left=r+"px";d.style.top=t+"px";l=window.innerWidth||Math.max(document.body.offsetWidth,document.documentElement.offsetWidth);k=window.innerHeight||Math.max(document.body.offsetHeight,document.documentElement.offsetHeight);(a.options.container||document.body).appendChild(d);
h=d.getBoundingClientRect();if(0<h.bottom-k){var u=h.bottom-h.top;0<g.top-(g.bottom-h.top)-u?(d.style.top=(t=g.top-u)+"px",n=!1):u>k&&(d.style.height=k-5+"px",d.style.top=(t=g.bottom-h.top)+"px",k=e.getCursor(),b.from.ch!=k.ch&&(g=e.cursorCoords(k),d.style.left=(r=g.left)+"px",h=d.getBoundingClientRect()))}k=h.right-l;0<k&&(h.right-h.left>l&&(d.style.width=l-5+"px",k-=h.right-h.left-l),d.style.left=(r=g.left-k)+"px");e.addKeyMap(this.keyMap=w(a,{moveFocus:function(a,b){c.changeActive(c.selectedHint+
a,b)},setFocus:function(a){c.changeActive(a)},menuSize:function(){return c.screenAmount()},length:m.length,close:function(){a.close()},pick:function(){c.pick()},data:b}));if(a.options.closeOnUnfocus){var p;e.on("blur",this.onBlur=function(){p=setTimeout(function(){a.close()},100)});e.on("focus",this.onFocus=function(){clearTimeout(p)})}var q=e.getScrollInfo();e.on("scroll",this.onScroll=function(){var c=e.getScrollInfo(),b=e.getWrapperElement().getBoundingClientRect(),f=t+q.top-c.top,g=f-(window.pageYOffset||
(document.documentElement||document.body).scrollTop);n||(g+=d.offsetHeight);if(g<=b.top||g>=b.bottom)return a.close();d.style.top=f+"px";d.style.left=r+q.left-c.left+"px"});f.on(d,"dblclick",function(a){(a=v(d,a.target||a.srcElement))&&null!=a.hintId&&(c.changeActive(a.hintId),c.pick())});f.on(d,"click",function(b){(b=v(d,b.target||b.srcElement))&&null!=b.hintId&&(c.changeActive(b.hintId),a.options.completeOnSingleClick&&c.pick())});f.on(d,"mousedown",function(){setTimeout(function(){e.focus()},20)});
f.signal(b,"select",m[0],d.firstChild);return!0}f.showHint=function(a,b,c){if(!b)return a.showHint(c);c&&c.async&&(b.async=!0);b={hint:b};if(c)for(var e in c)b[e]=c[e];return a.showHint(b)};f.defineExtension("showHint",function(a){1<this.listSelections().length||this.somethingSelected()||(this.state.completionActive&&this.state.completionActive.close(),a=this.state.completionActive=new p(this,a),a.options.hint&&(f.signal(this,"startCompletion",this),a.update()))});var x=window.requestAnimationFrame||
function(a){return setTimeout(a,1E3/60)},y=window.cancelAnimationFrame||clearTimeout;p.prototype={close:function(){this.active()&&(this.tick=this.cm.state.completionActive=null,this.cm.off("cursorActivity",this.activityFunc),this.widget&&this.widget.close(),f.signal(this.cm,"endCompletion",this.cm))},active:function(){return this.cm.state.completionActive==this},pick:function(a,b){var c=a.list[b];c.hint?c.hint(this.cm,a,c):this.cm.replaceRange("string"==typeof c?c:c.text,c.from||a.from,c.to||a.to,
"complete");f.signal(a,"pick",c);this.close()},showHints:function(a){if(!a||!a.list.length||!this.active())return this.close();this.options.completeSingle&&1==a.list.length?this.pick(a,0):this.showWidget(a)},cursorActivity:function(){this.debounce&&(y(this.debounce),this.debounce=0);var a=this.cm.getCursor(),b=this.cm.getLine(a.line);if(a.line!=this.startPos.line||b.length-a.ch!=this.startLen-this.startPos.ch||a.ch<this.startPos.ch||this.cm.somethingSelected()||a.ch&&this.options.closeCharacters.test(b.charAt(a.ch-
1)))this.close();else{var c=this;this.debounce=x(function(){c.update()});this.widget&&this.widget.disable()}},update:function(){if(null!=this.tick)if(this.data&&f.signal(this.data,"update"),this.options.hint.async){var a=++this.tick,b=this;this.options.hint(this.cm,function(c){b.tick==a&&b.finishUpdate(c)},this.options)}else this.finishUpdate(this.options.hint(this.cm,this.options),a)},finishUpdate:function(a){this.data=a;var b=this.widget&&this.widget.picked;this.widget&&this.widget.close();a&&a.list.length&&
(b&&1==a.list.length?this.pick(a,0):this.widget=new n(this,a))},showWidget:function(a){this.data=a;this.widget=new n(this,a);f.signal(a,"shown")},buildOptions:function(a){var b=this.cm.options.hintOptions,c={},e;for(e in q)c[e]=q[e];if(b)for(e in b)void 0!==b[e]&&(c[e]=b[e]);if(a)for(e in a)void 0!==a[e]&&(c[e]=a[e]);return c}};n.prototype={close:function(){if(this.completion.widget==this){this.completion.widget=null;this.hints.parentNode.removeChild(this.hints);this.completion.cm.removeKeyMap(this.keyMap);
var a=this.completion.cm;this.completion.options.closeOnUnfocus&&(a.off("blur",this.onBlur),a.off("focus",this.onFocus));a.off("scroll",this.onScroll)}},disable:function(){this.completion.cm.removeKeyMap(this.keyMap);var a=this;this.keyMap={Enter:function(){a.picked=!0}};this.completion.cm.addKeyMap(this.keyMap)},pick:function(){this.completion.pick(this.data,this.selectedHint)},changeActive:function(a,b){a>=this.data.list.length?a=b?this.data.list.length-1:0:0>a&&(a=b?0:this.data.list.length-1);
if(this.selectedHint!=a){var c=this.hints.childNodes[this.selectedHint];c.className=c.className.replace(" CodeMirror-hint-active","");c=this.hints.childNodes[this.selectedHint=a];c.className+=" CodeMirror-hint-active";c.offsetTop<this.hints.scrollTop?this.hints.scrollTop=c.offsetTop-3:c.offsetTop+c.offsetHeight>this.hints.scrollTop+this.hints.clientHeight&&(this.hints.scrollTop=c.offsetTop+c.offsetHeight-this.hints.clientHeight+3);f.signal(this.data,"select",this.data.list[this.selectedHint],c)}},
screenAmount:function(){return Math.floor(this.hints.clientHeight/this.hints.firstChild.offsetHeight)||1}};f.registerHelper("hint","auto",function(a,b){var c=a.getHelpers(a.getCursor(),"hint");if(c.length)for(var e=0;e<c.length;e++){var d=c[e](a,b);if(d&&d.list.length)return d}else if(c=a.getHelper(a.getCursor(),"hintWords")){if(c)return f.hint.fromList(a,{words:c})}else if(f.hint.anyword)return f.hint.anyword(a,b)});f.registerHelper("hint","fromList",function(a,b){for(var c=a.getCursor(),e=a.getTokenAt(c),
d=[],m=0;m<b.words.length;m++){var g=b.words[m];g.slice(0,e.string.length)==e.string&&d.push(g)}if(d.length)return{list:d,from:f.Pos(c.line,e.start),to:f.Pos(c.line,e.end)}});f.commands.autocomplete=f.showHint;var q={hint:f.hint.auto,completeSingle:!0,alignWithWord:!0,closeCharacters:/[\s()\[\]{};:>,]/,closeOnUnfocus:!0,completeOnSingleClick:!1,container:null,customKeys:null,extraKeys:null};f.defineOption("hintOptions",null)});