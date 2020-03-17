$(document).ready(function() {

    //ADS Listing function
    $("#user-list-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".list-group-item").filter(function() {
            $(this).toggle($(this).find('.namaads, .kodeads').text().toLowerCase().indexOf(value) > -1)
        });
    });


    // Program Listing Function

    $("#program-list-search-listing").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".list-group-item").filter(function() {
            $(this).toggle($(this).find('.namaads, .kodeprogram').text().toLowerCase().indexOf(value) > -1)
        });
    });

    //-------------------------------------


    // ,,MY'' Program Listing Function

    $("#program-list-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".list-group-item").filter(function() {
            $(this).not("#profilbox").toggle($(this).find('.namaprogram, .kodeprogram').text().toLowerCase().indexOf(value) > -1)
        });
    });







    //----Edit Program toggle tanggal selesai radio
    $(function() {
        $('input[name=radiostatus]').change(function() {
            $('.tanggalselesaitoggle').slideToggle();
        });
    });

    //-------------------------------------


    //Program status toggle radio button
    $(function() {
        $('input[name=radiofilterstatus]').change(function() {
            var value = $(this).val();
            if ($(this).val() != "Semua") {
                $(".list-group-item").filter(function() {
                    $(this).toggle($(this).find('.status').text().indexOf(value) > -1)
                });
            } else {
                $(".list-group-item").show();
            }
        });
    });
    //--------------------------------------



    //--------------Month translate

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('January', 'Januari'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('February', 'Februari'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('March', 'Maret'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('May', 'Mei'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('June', 'Juni'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('July', 'Juli'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('August', 'Agustus'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('October', 'Oktober'));
    });

    $('.catatantanggal, .targetdate, .bdads, .selesaicapaian, .tanggalcapaian, .tanggalselesai, .tanggaltarget, #tanggalartikel').each(function() {
        var text = $(this).text();
        $(this).text(text.replace('December', 'Desember'));
    });



    //DOM elements
    const DOMstrings = {
        stepsBtnClass: 'multisteps-form__progress-btn',
        stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
        stepsBar: document.querySelector('.multisteps-form__progress'),
        stepsForm: document.querySelector('.multisteps-form__form'),
        stepsFormTextareas: document.querySelectorAll('.multisteps-form__textarea'),
        stepFormPanelClass: 'multisteps-form__panel',
        stepFormPanels: document.querySelectorAll('.multisteps-form__panel'),
        stepPrevBtnClass: 'js-btn-prev',
        stepNextBtnClass: 'js-btn-next'
    };


    //remove class from a set of items
    const removeClasses = (elemSet, className) => {

        elemSet.forEach(elem => {

            elem.classList.remove(className);

        });

    };

    //return exect parent node of the element
    const findParent = (elem, parentClass) => {

        let currentNode = elem;

        while (!currentNode.classList.contains(parentClass)) {
            currentNode = currentNode.parentNode;
        }

        return currentNode;

    };

    //get active button step number
    const getActiveStep = elem => {
        return Array.from(DOMstrings.stepsBtns).indexOf(elem);
    };

    //set all steps before clicked (and clicked too) to active
    const setActiveStep = activeStepNum => {

        //remove active state from all the state
        removeClasses(DOMstrings.stepsBtns, 'js-active');

        //set picked items to active
        DOMstrings.stepsBtns.forEach((elem, index) => {

            if (index <= activeStepNum) {
                elem.classList.add('js-active');
            }

        });
    };

    //get active panel
    const getActivePanel = () => {

        let activePanel;

        DOMstrings.stepFormPanels.forEach(elem => {

            if (elem.classList.contains('js-active')) {

                activePanel = elem;

            }

        });

        return activePanel;

    };

    //open active panel (and close unactive panels)
    const setActivePanel = activePanelNum => {

        //remove active class from all the panels
        removeClasses(DOMstrings.stepFormPanels, 'js-active');

        //show active panel
        DOMstrings.stepFormPanels.forEach((elem, index) => {
            if (index === activePanelNum) {

                elem.classList.add('js-active');

                setFormHeight(elem);

            }
        });

    };

    //set form height equal to current panel height
    const formHeight = activePanel => {

        const activePanelHeight = activePanel.offsetHeight;

        DOMstrings.stepsForm.style.height = `${activePanelHeight}px`;

    };

    const setFormHeight = () => {
        const activePanel = getActivePanel();

        formHeight(activePanel);
    };

    //STEPS BAR CLICK FUNCTION
    DOMstrings.stepsBar.addEventListener('click', e => {

        //check if click target is a step button
        const eventTarget = e.target;

        if (!eventTarget.classList.contains(`${DOMstrings.stepsBtnClass}`)) {
            return;
        }

        //get active button step number
        const activeStep = getActiveStep(eventTarget);

        //set all steps before clicked (and clicked too) to active
        setActiveStep(activeStep);

        //open active panel
        setActivePanel(activeStep);
    });

    //PREV/NEXT BTNS CLICK
    DOMstrings.stepsForm.addEventListener('click', e => {

        const eventTarget = e.target;

        //check if we clicked on `PREV` or NEXT` buttons
        if (!(eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`) || eventTarget.classList.contains(`${DOMstrings.stepNextBtnClass}`))) {
            return;
        }

        //find active panel
        const activePanel = findParent(eventTarget, `${DOMstrings.stepFormPanelClass}`);

        let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);

        //set active step and active panel onclick
        if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
            activePanelNum--;

        } else {

            activePanelNum++;

        }

        setActiveStep(activePanelNum);
        setActivePanel(activePanelNum);

    });

    //SETTING PROPER FORM HEIGHT ONLOAD
    window.addEventListener('load', setFormHeight, false);

    //SETTING PROPER FORM HEIGHT ONRESIZE
    window.addEventListener('resize', setFormHeight, false);

    //changing animation via animation select !!!YOU DON'T NEED THIS CODE (if you want to change animation type, just change form panels data-attr)

    const setAnimationType = newType => {
        DOMstrings.stepFormPanels.forEach(elem => {
            elem.dataset.animation = newType;
        });
    };

    //selector onchange - changing animation
    const animationSelect = document.querySelector('.pick-animation__select');

    animationSelect.addEventListener('change', () => {
        const newAnimationType = animationSelect.value;

        setAnimationType(newAnimationType);
    });



}); //---jQuery END -----