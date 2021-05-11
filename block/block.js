(function (blocks, editor, components, i18n, element) {
    var el = wp.element.createElement;
    var registerBlockType = wp.blocks.registerBlockType;
    const { RichText, InspectorControls } = editor;
    var MediaUpload = wp.editor.MediaUpload;
    var TextControl = components.TextControl;
    var IconButton = components.IconButton;
    
	const { Fragment, useState } = element;
    const {
    	RangeControl,
    	Panel,
    	PanelBody
    } = components;
 
    blocks.registerBlockType( 'pickle-countdown/block', {
        title: 'Pickle Countdown',
        icon: 'calendar',
        category: 'layout',
        attributes: { 
            date: {
                type: 'string',
                default: 'n/a',
            },
            format: {
                type: 'string',
                default: '%D days %H:%M:%S'
            },			          
        },
        edit: function(props) {
            var attributes = props.attributes;
            
            return (          
                el( Fragment, {},
                    el( InspectorControls, {},
                    	el( PanelBody, { title: 'Countdown Settings', initialOpen: true },
                            el( TextControl, {
								label: 'Date',
								onChange: ( value ) => {
									props.setAttributes( { format: value } );
								},
								value: attributes.date
							}),
                            el( TextControl, {
								label: 'Format',
								onChange: ( value ) => {
									props.setAttributes( { format: value } );
								},
								value: attributes.format
							})
                    	) 
                    ),                                     
                    el('div', { className: props.className },
                        el('div', { className: 'pickle-countdown', id: 'pickle-countdown' },                    
                            el('div', { className: 'timer' },					
                            )
                        )
                    )
                )
            )
        },
        save: function (props) {
            var attributes = props.attributes;
            
            return (
                el( 'div', { className: props.className },
                    el('div', { className: 'pickle-countdown', id: 'pickle-countdown' },  
                        el( 'div', { className: 'timer' },
                        ),
                                //attributes.lastWeek && el( 'div', { className: 'power-ranking-rider-last-week' }, attributes.lastWeek )
                    )
                )
            );
        }
    } );
}(
    window.wp.blocks,
    window.wp.editor,
    window.wp.components,
    window.wp.i18n,
    window.wp.element
) );

function countdownTimer() {
    const difference = +new Date("2020-01-01") - +new Date();
    let remaining = "Time's up!";
    
    if (difference > 0) {
      const parts = {
        days: Math.floor(difference / (1000 * 60 * 60 * 24)),
        hours: Math.floor((difference / (1000 * 60 * 60)) % 24),
        minutes: Math.floor((difference / 1000 / 60) % 60),
        seconds: Math.floor((difference / 1000) % 60)
      };
    
      remaining = Object.keys(parts)
        .map(part => {
          if (!parts[part]) return;
          return `${parts[part]} ${part}`;
        })
        .join(" ");
    }
    
    document.getElementById("countdown").innerHTML = remaining;
}

countdownTimer();
setInterval(countdownTimer, 1000);