<?php 
/*!
AniJS - http://anijs.github.io
Licensed under the MIT license

Copyright (c) 2014 Dariel Noel <darielnoel@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
?>
<script>

$(document).ready(function() {
$('.elgg-item').css('visibility', 'visible');
});

(function(root, factory) {
    "use strict";
    if (typeof module == "object" && typeof module.exports == "object") {
        module.exports = root.document ?
            factory(root, true) :
            function(w) {
                if (!w.document) {
                    throw new Error("AniJS-RWWD");
                }
                return factory(w);
        };
    } else {
        factory(root);
    }

})(typeof window !== "undefined" ? window : this, function(window, noGlobal) {


    /**
     * AniJS is library for write declarative animations in your static html documents
     * @class AniJSit
     * @constructor init
     * @author @dariel_noel
     */
    var AniJS = (function(AniJS) {

        var ANIJS_DATATAG_NAME = 'data-anijs',
            DEFAULT = 'default',
            BODY = 'body',
            PARAMS_SEPARATOR = '|',
            MULTIPLE_CLASS_SEPARATOR = '$',
            EVENT_RESERVED_WORD = 'if',
            EVENT_TARGET_RESERVED_WORD = 'on',
            BEHAVIOR_RESERVED_WORD = ['do', 'after', 'before', 'to'],
            BEHAVIOR_TARGET_RESERVED_WORD = 'to',
            REGEX_BEGIN = '(\\s+|^)',
            REGEX_END = '(\\s+|$)',
            ANIMATION_END = 'animationend',
            TRANSITION_END = 'transitionend',
            TARGET = 'target';

        AniJS = {

            rootDOMTravelScope: {},

            notifierCollection: {},

            /**
             * Initializer Function
             * @method init
             * @return
             */
            init: function() {

                //ATTRS inicialization
                selfish._helperCollection = {};

                var defaultHelper = selfish._createDefaultHelper();

                //Registering an empty helper
                AniJS.registerHelper(DEFAULT, defaultHelper);

                //Default Helper Index
                selfish._helperDefaultIndex = DEFAULT;

                AniJS.rootDOMTravelScope = document;

                //Initialize the Parser Object
                AniJS.Parser = selfish.Parser;

                //AnimationEnd Correct Prefix Setup
                selfish._animationEndEvent = selfish._animationEndPrefix();

                //Add this class names when anim
                selfish._classNamesWhenAnim = '';
            },

            setDOMRootTravelScope: function(selector) {
                var rootDOMTravelScope,
                    domDocument = document;
                try {
                    if (selector === 'document') {
                        rootDOMTravelScope = domDocument;
                    } else {
                        rootDOMTravelScope = domDocument.querySelector(selector);
                        if (!rootDOMTravelScope) {
                            rootDOMTravelScope = domDocument;
                        }
                    }

                } catch (e) {
                    rootDOMTravelScope = domDocument;
                }
                AniJS.rootDOMTravelScope = rootDOMTravelScope;
            },
			
            run: function() {
                var aniJSNodeCollection = [],
                    aniJSParsedSentenceCollection = {};

                AniJS.purgeAll();

                AniJS.notifierCollection = {};

                aniJSNodeCollection = selfish._findAniJSNodeCollection(AniJS.rootDOMTravelScope);

                var size = aniJSNodeCollection.length,
                    i = 0,
                    item;

                for (i; i < size; i++) {
                    item = aniJSNodeCollection[i];

                    aniJSParsedSentenceCollection = selfish._getParsedAniJSSentenceCollection(item.getAttribute(ANIJS_DATATAG_NAME));

                    selfish._setupElementAnim(item, aniJSParsedSentenceCollection);
                }

                //We can use this for supply the window load and DomContentLoaded in some context
                var aniJSEventsNotifier = AniJS.getNotifier('AniJSNotifier');
                if(aniJSEventsNotifier){
                    aniJSEventsNotifier.dispatchEvent('onRunFinished');
                }
            },

            createAnimation: function(aniJSParsedSentenceCollection, element) {
                var nodeElement = element || '';
                //BEAUTIFY: The params order migth be the same
                selfish._setupElementAnim(nodeElement, aniJSParsedSentenceCollection);
            },

            getHelper: function(helperID) {
                var helperCollection = selfish._helperCollection;
                return helperCollection[helperID] || helperCollection[DEFAULT];
            },


            registerHelper: function(helperName, helperInstance) {
                selfish._helperCollection[helperName] = helperInstance;
            },

 
            purge: function(selector) {
                if (selector && selector !== '' && selector !== ' ') {
                    var purgeNodeCollection = document.querySelectorAll(selector),
                        size = purgeNodeCollection.length,
                        i = 0;

                    for (i; i < size; i++) {
                        AniJS.EventSystem.purgeEventTarget(purgeNodeCollection[i]);
                    }
                }
            },

            purgeAll: function() {
                AniJS.EventSystem.purgeAll();
            },
  
            purgeEventTarget: function(element) {
                AniJS.EventSystem.purgeEventTarget(element);
            },

            setClassNamesWhenAnim: function(defaultClasses) {
                selfish._classNamesWhenAnim = ' ' + defaultClasses;
            },

            createNotifier: function() {
                return AniJS.EventSystem.createEventTarget();
            },

            registerNotifier: function(notifier) {
                var notifierCollection = AniJS.notifierCollection;

                //TODO: Optimize lookups here
                if (notifier.id && notifier.value && AniJS.EventSystem.isEventTarget(notifier.value)) {
                    notifierCollection[notifier.id] = notifier.value;
                    return 1;
                }

                return '';
            },

            getNotifier: function(notifierID) {
                return AniJS.notifierCollection[notifierID];
            }

        };

        var selfish = {

        };

        selfish._createDefaultHelper = function() {
            var defaultHelper = {
       
                removeAnim: function(e, animationContext) {
                    if(e.target && e.type){
                      animationContext.nodeHelper.removeClass(e.target, animationContext.behavior);
                    }
                },

                holdAnimClass: function(e, animationContext) {
                },

                fireOnce: function(e, animationContext) {
                    animationContext.eventSystem.removeEventListenerHelper(animationContext.eventTarget, animationContext.event.type, animationContext.listener);
                },

                emit: function(e, ctx, params) {
                    var cevent = params[0] || null,
                        notifier = "";
                    if(cevent !== null) {
                        cevent = cevent.split('.');
                        if(cevent.length > 1) {
                            notifier = cevent[0];
                            cevent = cevent[1];
                        } else {
                            notifier = "";
                            cevent = cevent[0];
                        }
                        var customNotifier = AniJS.getNotifier(notifier) || null;
                        if(customNotifier !== null)
                            customNotifier.dispatchEvent(cevent);
                    }
                  
                    if(!ctx.hasRunned){
                        ctx.run();
                    }
                }
            };

            return defaultHelper;
        };

        selfish._createParser = function() {
           
            return new Parser();
        };

        selfish._setupElementAnim = function(element, aniJSParsedSentenceCollection) {
            var size = aniJSParsedSentenceCollection.length,
                i = 0,
                item;

            for (i; i < size; i++) {
                item = aniJSParsedSentenceCollection[i];
                selfish._setupElementSentenceAnim(element, item);
            }
        };

   
        selfish._setupElementSentenceAnim = function(element, aniJSParsedSentence) {
            var event = selfish._eventHelper(aniJSParsedSentence),
                eventTargetList = selfish._eventTargetHelper(element, aniJSParsedSentence),
                afterFunctionName;

            if(aniJSParsedSentence.after && selfish.Util.beArray(aniJSParsedSentence.after)){
                afterFunctionName =  aniJSParsedSentence.after[0];
            }

            if (event !== '') {
                var size = eventTargetList.length,
                    i = 0,
                    eventTargetItem;
                for (i; i < size; i++) {
                    eventTargetItem = eventTargetList[i];
                    if (AniJS.EventSystem.isEventTarget(eventTargetItem)) {
                        var listener = function(event) {

                            var behaviorTargetList = selfish._behaviorTargetHelper(element, aniJSParsedSentence, event),
                                behavior = selfish._behaviorHelper(aniJSParsedSentence),
                                before = selfish._beforeHelper(element, aniJSParsedSentence),
                                after = selfish._afterHelper(element, aniJSParsedSentence);
                            if (selfish._classNamesWhenAnim !== '') {
                                if(!selfish.Util.beArray(behavior))
                                    behavior += selfish._classNamesWhenAnim;
                            }

                            var animationContextConfig = {
                                behaviorTargetList: behaviorTargetList,
                                nodeHelper: selfish.NodeHelper,
                                animationEndEvent: selfish._animationEndEvent,
                                behavior: behavior,
                                after: after,
                                eventSystem: AniJS.EventSystem,
                                eventTarget: event.currentTarget,
                                afterFunctionName: afterFunctionName,
                                dataAniJSOwner: element,
                                listener: listener,
                                event: event,
                                before: before
                            },

                            animationContextInstance = new AniJS.AnimationContext(animationContextConfig);

                            animationContextInstance.runAll(animationContextConfig);
                        };

                        AniJS.EventSystem.addEventListenerHelper(eventTargetItem, event, listener, false);

                        AniJS.EventSystem.registerEventHandle(eventTargetItem, event, listener);
                    }
                }
            }
        };

        selfish._eventHelper = function(aniJSParsedSentence) {
            var defaultValue = '',
                event = aniJSParsedSentence.event || defaultValue;

            if (event === ANIMATION_END) {
                event = selfish._animationEndPrefix();
            } else if (event === TRANSITION_END) {
                event = selfish._transitionEndPrefix();
            }

            return event;
        };

        selfish._eventTargetHelper = function(element, aniJSParsedSentence) {
            var defaultValue = element,
                eventTargetList = [defaultValue],
                rootDOMTravelScope = AniJS.rootDOMTravelScope,
                notifierList;

        
            if (aniJSParsedSentence.eventTarget) {

                notifierList = selfish._notifierHelper(aniJSParsedSentence.eventTarget);

                if (notifierList.length > 0) {
                    eventTargetList = notifierList;
                } else if (aniJSParsedSentence.eventTarget === 'document') {
                    eventTargetList = [document];
                } else if (aniJSParsedSentence.eventTarget === 'window') {
                    eventTargetList = [window];
                } else if (aniJSParsedSentence.eventTarget.split) {
                    try {
                        eventTargetList = rootDOMTravelScope.querySelectorAll(aniJSParsedSentence.eventTarget);
                    } catch (e) {
                        console.log('Ugly Selector Here');
                        eventTargetList = [];
                    }
                }
            }
           
            return eventTargetList;
        };


        selfish._behaviorTargetHelper = function(element, aniJSParsedSentence, event) {
            var defaultValue = element,
                behaviorTargetNodeList = [defaultValue],
                rootDOMTravelScope = AniJS.rootDOMTravelScope,
                behaviorTarget = aniJSParsedSentence.behaviorTarget;

            if (behaviorTarget) {
                if(!selfish.Util.beArray(behaviorTarget)){
                    if(behaviorTarget === TARGET && event.currentTarget){
                        behaviorTargetNodeList = [event.currentTarget];
                    } else{
                       
                        behaviorTarget = behaviorTarget.split(MULTIPLE_CLASS_SEPARATOR).join(',');
                        try {
                            behaviorTargetNodeList = rootDOMTravelScope.querySelectorAll(behaviorTarget);
                        } catch (e) {
                            behaviorTargetNodeList = [];
                        }
                    }
                } else{
                    var behaviorObject = this._actionHelper(element, aniJSParsedSentence, behaviorTarget);
                    if(behaviorObject && selfish.Util.isFunction(behaviorObject[0])){
                        behaviorTargetNodeList = behaviorObject[0]
                                                    (event,{dataAniJSOwner:element},
                                                    selfish._paramsHelper(behaviorObject));
                    }
                }
            }
            return behaviorTargetNodeList;
        };

   
        selfish._behaviorHelper = function(aniJSParsedSentence) {
            return this._actionHelper({}, aniJSParsedSentence, aniJSParsedSentence.behavior);
        };

      
        selfish._afterHelper = function(element, aniJSParsedSentence) {
            var defaultValue =  aniJSParsedSentence.after;
            
            if(!selfish.Util.beArray(defaultValue))
                return selfish._callbackHelper(element, aniJSParsedSentence, defaultValue);
            return this._actionHelper(element, aniJSParsedSentence, defaultValue);
        };

 
        selfish._beforeHelper = function(element, aniJSParsedSentence) {
            var defaultValue =  aniJSParsedSentence.before;
            if(!selfish.Util.beArray(defaultValue))
                return selfish._callbackHelper(element, aniJSParsedSentence, defaultValue);
            return this._actionHelper(element, aniJSParsedSentence, defaultValue);
        };

        selfish._actionHelper = function(element, aniJSParsedSentence, action) {
            var defaultValue = action || '',
                executeFunction;
            if(selfish.Util.beArray(defaultValue)) {
                executeFunction = selfish._callbackHelper(element, aniJSParsedSentence, defaultValue[0]);
                if(executeFunction) {
                    defaultValue[0] = executeFunction;
                } else {
                    defaultValue = defaultValue.join(' ');
                }

            }
            return defaultValue;
        };

       
        selfish._callbackHelper = function(element, aniJSParsedSentence, callbackFunction) {
            var defaultValue = callbackFunction || '',
                helper = selfish._helperHelper(aniJSParsedSentence);

            if (defaultValue) {
                if (!selfish.Util.isFunction(defaultValue)) {
                    var helperCollection = selfish._helperCollection,
                        helperInstance = helperCollection[helper];

                    if (helperInstance && selfish.Util.isFunction(helperInstance[defaultValue])) {
                        defaultValue = helperInstance[defaultValue];
                    } else {
                        defaultValue = false;
                    }
                }
            }

            return defaultValue;
        };

  
        selfish._helperHelper = function(aniJSParsedSentence) {
            var defaultValue = aniJSParsedSentence.helper || selfish._helperDefaultIndex;
            return defaultValue;
        };

    
        selfish._notifierHelper = function(eventTargetDefinition) {
            var defaultValue = [],
                notifierCollection = AniJS.notifierCollection;

            if (eventTargetDefinition) {
               
                if (eventTargetDefinition.id && AniJS.EventSystem.isEventTarget(eventTargetDefinition.value)) {
                   
                    defaultValue.push(eventTargetDefinition.value);

                    AniJS.registerNotifier(eventTargetDefinition);
                } else if (eventTargetDefinition.split) {
                
                    notifierIDList = eventTargetDefinition.split('$');
                    var size = notifierIDList.length,
                        i = 1,
                        notifierID;

                    for (i; i < size; i++) {
                        notifierID = notifierIDList[i];
                        if (notifierID && notifierID !== ' ') {
                          
                            notifierID = notifierID.trim();
                            var value = AniJS.getNotifier(notifierID);
                            if (!value) {
                                value = AniJS.EventSystem.createEventTarget();
                                AniJS.registerNotifier({
                                    id: notifierID,
                                    value: value
                                });
                            }
                            defaultValue.push(value);
                        }
                    }
                }
            }

            return defaultValue;
        };

        selfish._paramsHelper = function(paramsArray){
            var arr = [],
                i = paramsArray.length;
            while(i-- > 1) arr[i - 1] = paramsArray[i];
            return arr;
        };

        selfish._getParsedAniJSSentenceCollection = function(stringDeclaration) {
            return selfish.Parser.parse(stringDeclaration);
        };


        selfish._findAniJSNodeCollection = function(rootDOMTravelScope) {
           
            var aniJSDataTagName = '[' + ANIJS_DATATAG_NAME + ']';
            return rootDOMTravelScope.querySelectorAll(aniJSDataTagName);
        };


        selfish._animationEndPrefix = function() {
            var endPrefixBrowserDetectionIndex = selfish._endPrefixBrowserDetectionIndex(),
                animationEndBrowserPrefix = [ANIMATION_END, 'oAnimationEnd', ANIMATION_END, 'webkitAnimationEnd'];

            return animationEndBrowserPrefix[endPrefixBrowserDetectionIndex];
        };

     
        selfish._transitionEndPrefix = function() {
            var endPrefixBrowserDetectionIndex = selfish._endPrefixBrowserDetectionIndex(),
                transitionEndBrowserPrefix = [TRANSITION_END, 'oTransitionEnd', TRANSITION_END, 'webkitTransitionEnd'];

            return transitionEndBrowserPrefix[endPrefixBrowserDetectionIndex];
        };

      
        selfish._endPrefixBrowserDetectionIndex = function() {
           
            var el = document.createElement('fe'),
                ANIM = 'Animation',
                animationBrowserDetection = ['animation', 'O'+ANIM, 'Moz'+ANIM, 'webkit'+ANIM];

            for (var i = 0; i < animationBrowserDetection.length; i++) {
                if (el.style[animationBrowserDetection[i]] !== undefined) {
                    return i;
                }
            }
        };

        AniJS.AnimationContext = (function(config) {           
            var animationContextInstance = this;

            animationContextInstance.init = function(config) {
        
                animationContextInstance.behaviorTargetList = config.behaviorTargetList || [];

                animationContextInstance.nodeHelper = config.nodeHelper;

                animationContextInstance.animationEndEvent = config.animationEndEvent;

                animationContextInstance.behavior = config.behavior;

                animationContextInstance.after = config.after;

                animationContextInstance.eventSystem = config.eventSystem;

                animationContextInstance.eventTarget = config.eventTarget;

                animationContextInstance.afterFunctionName = config.afterFunctionName;

                animationContextInstance.dataAniJSOwner = config.dataAniJSOwner;

                animationContextInstance.listener = config.listener;

                animationContextInstance.event = config.event;
                animationContextInstance.before = config.before;
            };

           
            animationContextInstance.doDefaultAction = function(target, behavior){
                var instance = animationContextInstance,
                    nodeHelper = instance.nodeHelper,
                    animationEndEvent = instance.animationEndEvent,
                    after = instance.after,
                    afterFunctionName = instance.afterFunctionName,
                    lastBehavior;

              
                instance.eventSystem.addEventListenerHelper(target, animationEndEvent, function(e) {
                    e.stopPropagation();
                   
                    instance.eventSystem.removeEventListenerHelper(e.target, e.type, arguments.callee);
                    if(after){
                        if(selfish.Util.isFunction(after)){
                            after(e, animationContextInstance);
                        } else if(selfish.Util.beArray(after)) {
                            after[0](e, animationContextInstance, selfish._paramsHelper(after));
                        }
                    }
                });
                
                if (afterFunctionName !== "holdAnimClass" && afterFunctionName !== "$holdAnimClass") {
                    lastBehavior = target._ajLastBehavior;
                    if(lastBehavior){
                        
                        nodeHelper.removeClass(target, lastBehavior);
                    }
                    target._ajLastBehavior = behavior;
                }
             
                target.offsetWidth = target.offsetWidth;
                nodeHelper.addClass(target, behavior);
            };

      
            animationContextInstance.doFunctionAction = function(target, behavior){
                var instance = animationContextInstance,
                    after = instance.after,
                    e = {target:target};
                behavior[0](e, animationContextInstance, selfish._paramsHelper(behavior));
                if(selfish.Util.isFunction(after)){
                    after(e, animationContextInstance);
                } else {
                    if(selfish.Util.beArray(after)) {
                        after[0](e, animationContextInstance, selfish._paramsHelper(after));
                    }
                }
            };

         
            animationContextInstance.runAll = function() {
                var instance = animationContextInstance,
                    behaviorTargetList = instance.behaviorTargetList,
                    behaviorTargetListSize = behaviorTargetList.length,
                    behavior = instance.behavior,
                    j = 0,
                    before = instance.before,
                    simpleAnimationContextInstance,
                    event = animationContextInstance.event,
                    animationContextConfig;

                for (j; j < behaviorTargetListSize; j++) {

                    animationContextConfig = {
                        behaviorTargetList: [behaviorTargetList[j]],
                        nodeHelper: animationContextInstance.nodeHelper,
                        animationEndEvent: animationContextInstance.animationEndEvent,
                        behavior: animationContextInstance.behavior,
                        after: animationContextInstance.after,
                        eventSystem: animationContextInstance.eventSystem,
                        eventTarget: animationContextInstance.eventTarget,
                        afterFunctionName: animationContextInstance.afterFunctionName,
                        dataAniJSOwner: animationContextInstance.dataAniJSOwner,
                        listener: animationContextInstance.listener,
                        event: event
                        
                    };

                    simpleAnimationContextInstance = new AniJS.AnimationContext(animationContextConfig);
                    if (before) {
                        if(selfish.Util.isFunction(before)) {
                            before(event, simpleAnimationContextInstance);
                        } else if(selfish.Util.beArray(before)) {
                            before[0](event, simpleAnimationContextInstance, selfish._paramsHelper(before));
                        }
                    } else {
                        simpleAnimationContextInstance.run();
                    }
                }
            };
          
            animationContextInstance.run = function() {
                var instance = animationContextInstance,
                    behavior = instance.behavior,
                    behaviorTargetListItem = instance.behaviorTargetList[0];

                animationContextInstance.hasRunned = 1;
                if(selfish.Util.beArray(behavior)){
                    instance
                        .doFunctionAction(behaviorTargetListItem, behavior);
                } else{
                    instance
                        .doDefaultAction(behaviorTargetListItem, behavior);
                }
            };

            animationContextInstance.init(config);
        });

  
        selfish.Parser = {

         
            parse: function(aniJSDeclaration) {
                return this.parseDeclaration(aniJSDeclaration);
            },

       
            parseDeclaration: function(declaration) {
                var parsedDeclaration = [],
                    sentenceCollection,
                    parsedSentence;

                sentenceCollection = declaration.split(';');

                var size = sentenceCollection.length,
                    i = 0;

                for (i; i < size; i++) {
                    parsedSentence = this.parseSentence(sentenceCollection[i]);
                    parsedDeclaration.push(parsedSentence);
                }

                return parsedDeclaration;
            },

    
            parseSentence: function(sentence) {
                var parsedSentence = {},
                    definitionCollection,
                    parsedDefinition;

                definitionCollection = sentence.split(',');

                var size = definitionCollection.length,
                    i = 0;

                for (i; i < size; i++) {
                    parsedDefinition = this.parseDefinition(definitionCollection[i]);
                    parsedSentence[parsedDefinition.key] = parsedDefinition.value;
                }
                return parsedSentence;
            },

         
            parseDefinition: function(definition) {
                var parsedDefinition = {},
                    definitionBody,
                    definitionKey,
                    definitionValue,
                    EVENT_KEY = 'event',
                    EVENT_TARGET_KEY = 'eventTarget',
                    BEHAVIOR_KEY = ['behavior', 'after', 'before', 'behaviorTarget'];

                
                definitionBody = definition.split(':');
                if (definitionBody.length > 1) {
                    definitionKey = definitionBody[0].trim();
                   
                    if(definitionBody.length > 2){
                        definitionValue = definitionBody.slice(1);
                        definitionValue = definitionValue.join(':');
                        definitionValue = definitionValue.trim();
                    } else {
                        definitionValue = definitionBody[1].trim();
                    }
                    parsedDefinition.value = definitionValue;
                
                    if (definitionKey === EVENT_RESERVED_WORD) {
                        definitionKey = EVENT_KEY;
                    } else if (definitionKey === EVENT_TARGET_RESERVED_WORD) {
                        definitionKey = EVENT_TARGET_KEY;
                    } else {
                        for (var i = BEHAVIOR_RESERVED_WORD.length - 1; i >= 0; i--) {
                              if(definitionKey === BEHAVIOR_RESERVED_WORD[i]) {
                                definitionKey = BEHAVIOR_KEY[i];
                          
                                if((definitionKey === 'after' || definitionKey === 'before') && definitionValue[0]!== '$') {
                                    definitionValue = '$' + definitionValue;
                                }
                                definitionValue = this.parseDoDefinition(definitionValue);
                              }
                        }
                    }
                    parsedDefinition.key = definitionKey;
                    parsedDefinition.value = definitionValue;
                }

                return parsedDefinition;
            },

    
            parseDoDefinition: function(doDefinition) {
                var reg = /^\$(\w+)\s*/g,
                    regMatch = reg.exec(doDefinition),
                    functionName = "",
                    parametersArray = [], it = 1;

                if(regMatch !== null) {
                    functionName = regMatch[1];
                    doDefinitionArray = doDefinition.split(regMatch[0])[1];
                    doDefinitionArray = doDefinitionArray !== null ? doDefinitionArray.split(PARAMS_SEPARATOR) : [];
                    doDefinition = [];
                    doDefinition[0] = functionName;
                    for (var i = 0; i < doDefinitionArray.length; i++) {
                        if(doDefinitionArray[i] !== "")
                            doDefinition[it++] = doDefinitionArray[i].trim();
                    }
                    return doDefinition;
                }
                return doDefinition;
            }
        };

  
        selfish.NodeHelper = {

      
            addClass: function(elem, string) {
                if (!(string instanceof Array)) {
                    string = string.split(' ');
                }
                for (var i = 0, len = string.length; i < len; ++i) {
                    if (string[i] && !new RegExp(REGEX_BEGIN + string[i] + REGEX_END).test(elem.className)) {
                        elem.className = (elem.className === "") ?  string[i] : elem.className.trim() + ' ' + string[i];
                    }
                }
            },

          
            removeClass: function(elem, string) {
                if (!(string instanceof Array)) {
                    string = string.split(' ');
                }
                for (var i = 0, len = string.length; i < len; ++i) {
                    elem.className = elem.className.replace(new RegExp(REGEX_BEGIN + string[i] + REGEX_END), ' ').trim();
                }
            },

          
            hasClass: function(elem, string) {
                return string && new RegExp(REGEX_BEGIN + string + REGEX_END).test(elem.className);
            }
        };

     
        selfish.Util = {

          
            isFunction: function(obj) {
                return !!(obj && obj.constructor && obj.call && obj.apply);
            },
    
            beArray:function(object){
                return Array.isArray(object);
            }
        };

    
        AniJS.EventSystem = {

            eventCollection: {},

            eventIdCounter: 0,

            isEventTarget: function(element) {
                return (element.addEventListener) ? 1 : 0;
            },

         
            createEventTarget: function() {
                return new AniJS.EventTarget();
            },

        
            addEventListenerHelper: function(eventTargetItem, event, listener, other) {
                eventTargetItem.addEventListener(event, listener, false);
            },

          
            removeEventListenerHelper: function(element, type, listener) {
                if(element){
                    element.removeEventListener(type, listener);
                }
            },


          
            purgeAll: function() {
                var instance = this,
                    eventCollection = instance.eventCollection,
                    eventCollectionKeyList = Object.keys(eventCollection),
                    size = eventCollectionKeyList.length,
                    i = 0,
                    key,
                    eventObject;

                for (i; i < size; i++) {
                    key = eventCollectionKeyList[i];
                    eventObject = eventCollection[key];

                    if (eventObject && eventObject.handleCollection && eventObject.handleCollection.length > 0) {
                        instance.purgeEventTarget(eventObject.handleCollection[0].element);
                    }

                    delete eventCollection[key];
                }
            },

        
            purgeAllNodes: function(element){
       
                var nodes = element.querySelectorAll("*");
                    size = nodes.length;
                for (var i = size - 1; i >= 0; i--) {
                    this.purgeEventTarget(nodes[i]);
                }
            },

         
            purgeEventTarget: function(element) {
                var instance = this,
                    aniJSEventID = element._aniJSEventID,
                    elementHandleCollection;
                if (aniJSEventID) {
               
                    elementHandleCollection = instance.eventCollection[aniJSEventID].handleCollection;

                    var size = elementHandleCollection.length,
                        i = 0,
                        item;

                    for (i; i < size; i++) {
                        item = elementHandleCollection[i];

             
                        instance.removeEventListenerHelper(element, item.eventType, item.listener);

                    }
                    instance.eventCollection[aniJSEventID] = element._aniJSEventID = null;
                    delete instance.eventCollection[aniJSEventID];
                    delete element._aniJSEventID;
                }
            },

          
            registerEventHandle: function(element, eventType, listener) {
                var instance = this,
                    aniJSEventID = element._aniJSEventID,
                    eventCollection = instance.eventCollection,
                    elementEventHandle = {
                        eventType: eventType,
                        listener: listener,
                        element: element
                    };

                if (aniJSEventID) {
                    eventCollection[aniJSEventID].handleCollection.push(elementEventHandle);
                } else {
                    var tempEventHandle = {
                        handleCollection: [elementEventHandle]
                    };

                    eventCollection[++instance.eventIdCounter] = tempEventHandle;
                    element._aniJSEventID = instance.eventIdCounter;
                }
            }

        };


       
        AniJS.EventTarget = function EventTarget() {
            this._listeners = {};
        };

        AniJS.EventTarget.prototype = {

            constructor: AniJS.EventTarget,

           
            addEventListener: function(type, listener, other) {
                var instance = this;
                if (typeof instance._listeners[type] == "undefined") {
                    instance._listeners[type] = [];
                }

                instance._listeners[type].push(listener);
            },

         
            dispatchEvent: function(event) {
                var instance = this;
                if (typeof event == "string") {
                    event = {
                        type: event
                    };
                }
                if (!event.target) {
                    event.target = instance;
                }

                if (!event.type) { 
                    throw new Error("Event object missing 'type' property.");
                }

                if (this._listeners[event.type] instanceof Array) {
                    var listeners = instance._listeners[event.type];

                    for (var i = 0, len = listeners.length; i < len; i++) {
                        listeners[i].call(instance, event);
                    }
                }
            },
          
            removeEventListener: function(type, listener) {
                var instance = this;
                if (instance._listeners[type] instanceof Array) {
                    var listeners = instance._listeners[type];
                    for (var i = 0, len = listeners.length; i < len; i++) {
                        if (listeners[i] === listener) {
                            listeners.splice(i, 1);
                            break;
                        }
                    }
                }
            }
        };

        return AniJS;

    }(AniJS || {}));

    AniJS.init();
    AniJS.run();

    if (typeof define === "function" && define.amd) {
        define("anijs", [], function() {
            return AniJS;
        });
    }
    if (typeof noGlobal == typeof undefined) {
        window.AniJS = AniJS;
    }

    return AniJS;
});

</script>
