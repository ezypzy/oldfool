$(function() {
    $('.tooltip').tooltip({
        animation: true,  //apply a css fade transition to the tooltip
        placement: 'top', //how to position the tooltip - top | bottom | left | right
        selector: false, //If a selector is provided, tooltip objects will be delegated to the specified targets.
        title: $(this).attr('title') || '',	//default title value if `title` tag isn't present
        trigger: 'hover', //how tooltip is triggered - hover | focus | manual
        // number | object	0	delay showing and hiding the tooltip (ms) - does not apply to manual trigger type
        // If a number is supplied, delay is applied to both hide/show
        // Object structure is: delay: { show: 500, hide: 100 }
        delay: 0
    });
});