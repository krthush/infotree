// DROPDOWN OF SIDEBAR TABS

$(function() {

	var button1 = $("#sidebarButton1");
	var content1 = $("#sidebarContent1");
    button1.mouseenter(function() {
    	var len = content1.queue('collapsequeue1').length;
    	if (len<1) {    	
			content1.queue('collapsequeue1',function(){
				content1.collapse('show');
			});
			if (!content1.hasClass("collapsing")) {
				content1.dequeue("collapsequeue1");
			}
		}
	});
	button1.mouseleave(function() {
    	var len = content1.queue('collapsequeue1').length;
    	if (len<1) {
			content1.queue('collapsequeue1',function(){
				content1.collapse('hide');
			});
			if (!content1.hasClass("collapsing")) {
				content1.dequeue("collapsequeue1");
			}
		}			
	});
	content1.on("shown.bs.collapse hidden.bs.collapse", function(){
		content1.dequeue("collapsequeue1");
	});
	
	var button2 = $("#sidebarButton2");
	var content2 = $("#sidebarContent2");
    button2.mouseenter(function() {
    	var len = content2.queue('collapsequeue2').length;
    	if (len<1) {    	
			content2.queue('collapsequeue2',function(){
				content2.collapse('show');
			});
			if (!content2.hasClass("collapsing")) {
				content2.dequeue("collapsequeue2");
			}
		}
	});
	button2.mouseleave(function() {
		var len = content2.queue('collapsequeue2').length;
    	if (len<1) {  	
			content2.queue('collapsequeue2',function(){
				content2.collapse('hide');
			});
			if (!content2.hasClass("collapsing")) {
				content2.dequeue("collapsequeue2");
			}
		}
	});
	content2.on("shown.bs.collapse hidden.bs.collapse", function(){
		content2.dequeue("collapsequeue2");
	});
	
	var button3 = $("#sidebarButton3");
	var content3 = $("#sidebarContent3");
    button3.mouseenter(function() {
    	var len = content3.queue('collapsequeue3').length;
    	if (len<1) {   	
			content3.queue('collapsequeue3',function(){
				content3.collapse('show');
			});
			if (!content3.hasClass("collapsing")) {
				content3.dequeue("collapsequeue3");
			}
		}
	});
	button3.mouseleave(function() {
    	var len = content3.queue('collapsequeue3').length;
    	if (len<1) {  	
			content3.queue('collapsequeue3',function(){
				content3.collapse('hide');
			});
			if (!content3.hasClass("collapsing")) {
				content3.dequeue("collapsequeue3");
			}
		}
	});
	content3.on("shown.bs.collapse hidden.bs.collapse", function(){
		content3.dequeue("collapsequeue3");
	});
	
	var button4 = $("#sidebarButton4");
	var content4 = $("#sidebarContent4");
    button4.mouseenter(function() {
    	var len = content4.queue('collapsequeue4').length;
    	if (len<1) {    	
			content4.queue('collapsequeue4',function(){
				content4.collapse('show');
			});
			if (!content4.hasClass("collapsing")) {
				content4.dequeue("collapsequeue4");
			}
		}
	});
	button4.mouseleave(function() {
		var len = content4.queue('collapsequeue4').length;
    	if (len<1) { 	
			content4.queue('collapsequeue4',function(){
				content4.collapse('hide');
			});
			if (!content4.hasClass("collapsing")) {
				content4.dequeue("collapsequeue4");
			}
		}
	});
	content4.on("shown.bs.collapse hidden.bs.collapse", function(){
		content4.dequeue("collapsequeue4");
	});

});

// $(document).ready(function() {
// 	"use strict";
// 	for (i = 1; i < 5; i++) {
// 		var num = i.toString();
// 		var strButton = "sidebarButton";
// 		var strContent = "sidebarContent";
// 		var button = strButton.concat(num);
// 		var content = strContent.concat(num);

// 		button.mouseenter(function() {    	
// 			content.queue('collapsequeue',function(){
// 				content.collapse('show');
// 			});
// 			if (!content.hasClass("collapsing")) {
// 				content.dequeue("collapsequeue");
// 			}
// 		});
// 		button.mouseleave(function() {	
// 			content.queue('collapsequeue',function(){
// 				content.collapse('hide');
// 			});
// 			if (!content.hasClass("collapsing")) {
// 				content.dequeue("collapsequeue");
// 			}
// 		});
// 		content.on("shown.bs.collapse hidden.bs.collapse", function(){
// 			content.dequeue("collapsequeue");
// 		});
// 	}

// });