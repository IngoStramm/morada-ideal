
let autocomplete;
let map;
let lat = ajax_object.lat;
let lng = ajax_object.lng;
const itemsLista = Object.values(ajax_object.imoveis);
const todosImoveis = itemsLista;
const allInfoWindows = [];
const markers = {};
console.log(ajax_object);


function initMap() {
    console.log('initMap 1');
    const mapDiv = document.getElementById('map');
    if (typeof (mapDiv) === undefined || !mapDiv) {
        return;
    }

    console.log('initMap 2');
    if ((typeof (lat) === undefined || !lat) || (typeof (lng) === undefined || !lng)) {
        return;
    }
    console.log('initMap 3');
    
    lat = Number(lat);
    lng = Number(lng);
    const defaultLocation = { lat, lng };
    // console.log('2 - lat', lat);
    // console.log('2 - lng', lng);
    map = new google.maps.Map(mapDiv, {
        zoom: 15,
        center: defaultLocation,
        mapTypeControl: false,
    });

    // const defaultLocationMarker = new google.maps.Marker({
    //     position: defaultLocation,
    //     map,
    //     title: "Sua localização",
    // });

    todosImoveis.forEach((imovel, i) => {
        const LatLng = { lat: parseFloat(imovel.lat), lng: parseFloat(imovel.lng) };
        const itemLocation = LatLng;
        const itemLocationContentString =
            `<div>
                <h5><a href="${imovel.post_url}">${imovel.title}</a></h5>
                <address>
                Endereço: ${imovel.rua}, ${imovel.numero} - ${imovel.cidade} / ${imovel.estado}, ${imovel.codigo_postal}
                </address>
            </div>`;
        const itemLocationInfowindow = new google.maps.InfoWindow({
            content: itemLocationContentString,
            ariaLabel: imovel.title,
        });
        allInfoWindows.push(itemLocationInfowindow);
        const itemLocationMarker = new google.maps.Marker({
            position: itemLocation,
            map,
            title: imovel.title,
        });
        // itemLocationMarker.addListener("click", () => {
        //     itemLocationInfowindow.open({
        //         anchor: itemLocationMarker,
        //         map,
        //     });
        // });
        // ref @link: https://jsfiddle.net/upsidown/8gjt0y6p/
        google.maps.event.addListener(itemLocationMarker, 'click', (function (itemLocationMarker, i) {

            return function () {
                closeAllInfoWindows();
                itemLocationInfowindow.setContent(itemLocationContentString);
                itemLocationInfowindow.open(map, itemLocationMarker);
                map.setZoom(16);
                map.setCenter(itemLocationMarker.getPosition());
            };

        })(itemLocationMarker, i));
        // markers.push(itemLocationMarker);
        markers[imovel.post_id] = itemLocationMarker;
        console.log('initMap 4');
    });

}

function closeAllInfoWindows() {
    for (const item of allInfoWindows) {
        item.close();
    }
}

// Validação dos forms
function miFormsValidation() {
    const forms = document.querySelectorAll('.needs-validation');

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
}

// Verifica a Força da senha
function miPasswordStrength() {
    const passwordInput = document.getElementById('user_pass');
    if (typeof passwordInput === undefined || !passwordInput) {
        return;
    }
    const meterSections = document.querySelectorAll('.meter-section');
    if (meterSections.length <= 0) {
        return;
    }

    passwordInput.addEventListener('keyup', () => miUpdateMeter(passwordInput, meterSections));
}

// Atualiza o medidor de força da senha
function miUpdateMeter(passwordInput, meterSections) {

    const password = passwordInput.value;
    let strength = miCalculatePasswordStrength(password);

    meterSections.forEach((section) => {
        section.classList.remove('weak', 'medium', 'strong', 'very-strong');
    });

    if (strength >= 1) {
        meterSections[0].classList.add('weak');
    }
    if (strength >= 2) {
        meterSections[1].classList.add('medium');
    }
    if (strength >= 3) {
        meterSections[2].classList.add('strong');
    }
    if (strength >= 4) {
        meterSections[3].classList.add('very-strong');
    }
    console.log('strength', strength);

}

// Calcula a força da senha
function miCalculatePasswordStrength(password) {
    const lengthWeight = 0.2;
    const uppercaseWeight = 0.5;
    const lowercaseWeight = 0.5;
    const numberWeight = 0.7;
    const symbolWeight = 1;

    let strength = 0;

    // Calculate the strength based on the password length
    strength += password.length * lengthWeight;

    // Calculate the strength based on uppercase letters
    if (/[A-Z]/.test(password)) {
        strength += uppercaseWeight;
    }

    // Calculate the strength based on lowercase letters
    if (/[a-z]/.test(password)) {
        strength += lowercaseWeight;
    }

    // Calculate the strength based on numbers
    if (/\d/.test(password)) {
        strength += numberWeight;
    }

    // Calculate the strength based on symbols
    if (/[^A-Za-z0-9]/.test(password)) {
        strength += symbolWeight;
    }
    return strength;
}

function miInitToasts() {
    const toasts = document.querySelectorAll('.toast');
    Array.from(toasts).forEach(toast => {
        console.log('toasts');
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
        toastBootstrap.show();
    });
}

function inputMasks() {
    const inputTelefone = document.getElementById('user_phone');
    const maskOptionsTelefone = {
        mask: '(00) 0000-0000[0]'
    };
    if (typeof inputTelefone !== undefined && inputTelefone) {
        const maskTelefone = IMask(inputTelefone, maskOptionsTelefone);
    }

    const inputWhatsApp = document.getElementById('user_whatsapp');
    const maskOptionsWhatsApp = {
        mask: '(00) 0000-00000'
    };
    if (typeof inputWhatsApp !== undefined && inputWhatsApp) {
        const maskWhatsApp = IMask(inputWhatsApp, maskOptionsWhatsApp);
    }

    const inputPrice = document.getElementById('imovel_price');
    const maskOptionsPrice = {
        mask: 'num',
        blocks: {
            num: {
                mask: Number,
                scale: 2,
                thousandsSeparator: '.',
                padFractionalZeros: true,
                radix: ',',
                mapToRadix: ['.'],
            }
        }
    };
    if (typeof inputPrice !== undefined && inputPrice) {
        const maskPrice = IMask(inputPrice, maskOptionsPrice);
    }
}

function miGoBackBtn() {
    const goBackBtns = document.querySelectorAll('.go-back-btn');
    Array.from(goBackBtns).forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            history.back();
        });
    });
}

function miLimitFileUploadSize() {
    const uploadFields = document.querySelectorAll('input[type="file"]');

    Array.from(uploadFields).forEach(uploadField => {
        uploadField.onchange = function () {
            if (this.files[0].size > 2097152) {
                alert('O arquivo é muito pesado, o tamanho máximo permitido é de 2MB.');
                this.value = "";
            }
        };
    });
}

function miTooltips() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
}

function miFileImagePreview() {
    const containers = document.querySelectorAll('.mi-file-image-preview');
    containers.forEach(container => {
        const fileInput = container.querySelector('input[type="file"]');
        const imagesPreviewContainer = container.querySelector('.images-preview');
        const btnClearImage = container.querySelector('.btn-clear-image');
        const changedThumbnail = container.querySelector('input[name="changed-thumbnail"]');
        btnClearImage.addEventListener('click', e => {
            e.preventDefault();
            fileInput.value = null;
            while (imagesPreviewContainer.firstChild) {
                imagesPreviewContainer.removeChild(imagesPreviewContainer.lastChild);
            }
            btnClearImage.style.display = 'none';
            changedThumbnail.value = 'true';
        });
        fileInput.addEventListener('change', e => {
            const newFiles = e.target.files;
            while (imagesPreviewContainer.firstChild) {
                imagesPreviewContainer.removeChild(imagesPreviewContainer.lastChild);
            }
            for (const newFile of newFiles) {
                const imagePreview = document.createElement('img');
                imagePreview.classList.add('image-preview');
                imagePreview.src = URL.createObjectURL(newFile);
                imagesPreviewContainer.append(imagePreview);
            }
            btnClearImage.style.display = 'block';
            changedThumbnail.value = 'true';
            console.log('fileInput', fileInput.value);

        });
        // fileInput.value = imagePreview.src;
        // const event = new Event('change');
        // fileInput.dispatchEvent(event);
    });
}

function miClearInputValue() {
    const clearInputValueLink = document.querySelectorAll('.clear-input-value');
    clearInputValueLink.forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const input = document.getElementById(link.dataset.input);
            if (typeof input !== undefined && input) {
                input.value = '';
            }
        });
    });
}

function mi_show_alert(alertPlaceholder, message, type) {
    console.log(message);
    const wrapper = document.createElement('div');
    wrapper.innerHTML = [
        `<div id="contact-form-alert" class="alert alert-${type} alert-dismissible" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('');
    alertPlaceholder.append(wrapper);
}

function mi_contact_form() {
    const contactForms = document.querySelectorAll('.mi-contact-form');
    contactForms.forEach(contactForm => {
        contactForm.addEventListener('submit', e => {
            e.preventDefault();

            if (typeof document.getElementById('contact-form-alert') !== undefined && document.getElementById('contact-form-alert')) {
                const contactFormAlert = bootstrap.Alert.getOrCreateInstance('#contact-form-alert');
                contactFormAlert.close();
            }

            if (!contactForm.checkValidity()) {
                return;
            }
            contactForm.classList.add('was-validated');

            const nomeInput = contactForm.querySelector('#nome');
            const emailInput = contactForm.querySelector('#email');
            const mensagemTextarea = contactForm.querySelector('#mensagem');
            const btn = contactForm.querySelector('button');

            if (typeof btn === undefined || !btn) {
                return;
            }

            if (btn.disabled) {
                return;
            }
            btn.disabled = true;
            const originalBtntext = btn.innerText;
            btn.innerText = 'Enviando...';

            const ajaxUrl = ajax_object.ajax_url;
            const data = new FormData(contactForm);
            const action = data.get('action');

            // console.log(data.get('action'));

            // for (const [key, value] of data) {
            //     console.log('data', `${key}: ${value}\n`);
            // }

            const alertPlaceholder = document.getElementById('contact-form-alert-placeholder');

            fetch(ajaxUrl, {
                method: 'POST',
                body: data
            })
                .then((response) => response.json())
                .then((response) => {
                    mi_show_alert(alertPlaceholder, response.data.msg, 'success');
                    nomeInput.value = '';
                    emailInput.value = '';
                    mensagemTextarea.value = '';
                })
                .catch((error) => {
                    console.error(error);
                    mi_show_alert(alertPlaceholder, error, 'danger');
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerText = originalBtntext;
                    contactForm.classList.remove('was-validated');
                });

        });
    });
}

function miSortTableList() {

    const defaultOptions = {
        page: 10,
        pagination: [{
            item: `<li class="page-item"><a class="page page-link"></a></li>`
        }]
    };

    const optionsListAnuncios = {
        ...defaultOptions,
        valueNames: ['titulo', 'data', 'status']
    };

    const optionsMyImoveis = {
        ...defaultOptions,
        valueNames: ['nome', 'data'],
    };

    const optionsFollowingTermsAnuncios = {
        ...defaultOptions,
        valueNames: ['nome', 'categorias', 'titulo', 'data'],
    };

    const optionsContactedAnuncios = {
        ...defaultOptions,
        valueNames: ['titulo', 'nome', 'data', 'status'],
    };

    const optionsTermsImoveis = {
        ...defaultOptions,
        valueNames: ['nome'],
        page: 10
    };

    const optionsRelatorioCat = {
        ...defaultOptions,
        valueNames: ['order', 'nome', 'minval', 'maxval', 'midval'],
        page: 10
    };

    const tableOperacaoImoveis = document.getElementById('table-operacao-imoveis');
    const tableListOperacaoProdutos = new List(tableOperacaoImoveis, optionsTermsImoveis);

    const tableTipoImoveis = document.getElementById('table-tipo-imoveis');
    const tableListTipoProdutos = new List(tableTipoImoveis, optionsTermsImoveis);

    const tableRegiaoImoveis = document.getElementById('table-regiao-imoveis');
    const tableListRegiaoProdutos = new List(tableRegiaoImoveis, optionsTermsImoveis);

    const tableCaracteristicasGeraisImoveis = document.getElementById('table-caracteristicas-gerais-imoveis');
    const tableListCaracteristicasGeraisProdutos = new List(tableCaracteristicasGeraisImoveis, optionsTermsImoveis);

    const tableTipologiaImoveis = document.getElementById('table-tipologia-imoveis');
    const tableListTipologiaProdutos = new List(tableTipologiaImoveis, optionsTermsImoveis);

    const tableOutrasDenominacoesImoveis = document.getElementById('table-outras-denominacoes-imoveis');
    const tableListOutrasDenominacoesProdutos = new List(tableOutrasDenominacoesImoveis, optionsTermsImoveis);

    const tableCasasDeBanhoImoveis = document.getElementById('table-casas-de-banho-imoveis');
    const tableListCasasDeBanhoProdutos = new List(tableCasasDeBanhoImoveis, optionsTermsImoveis);

    const tableEstadoImoveis = document.getElementById('table-estado-imoveis');
    const tableListEstadoProdutos = new List(tableEstadoImoveis, optionsTermsImoveis);

    const tableFiltroImoveis = document.getElementById('table-filtro-imoveis');
    const tableListFiltroProdutos = new List(tableFiltroImoveis, optionsTermsImoveis);

    const tableAndarImoveis = document.getElementById('table-andar-imoveis');
    const tableListAndarProdutos = new List(tableAndarImoveis, optionsTermsImoveis);

    // const tableAnuncios = document.getElementById('table-anuncios');
    // const tableListAnuncios = new List(tableAnuncios, optionsListAnuncios);

    const tableMyImoveis = document.getElementById('my-imoveis');
    const tableListMyImoveis = new List(tableMyImoveis, optionsMyImoveis);

    // const tableFollowingTermsAnuncios = document.getElementById('table-following-terms-anuncios');
    // const tableListFollowingTermsAnuncios = new List(tableFollowingTermsAnuncios, optionsFollowingTermsAnuncios);

    // const tableContactedAnuncios = document.getElementById('table-contacted-anuncios');
    // const tableListContactedAnuncios = new List(tableContactedAnuncios, optionsContactedAnuncios);

    // const tableFollowingCatProdutos = document.getElementById('table-following-cat-produtos');
    // const tableListFollowingCatProdutos = new List(tableFollowingCatProdutos, optionsOperacaoImoveis);

    // const tableRelatorioCat = document.getElementById('table-relatorio-cat');
    // const tableListRelatorioCat = new List(tableRelatorioCat, optionsRelatorioCat);

}

function miFaq() {
    const faqs = document.querySelectorAll('.mi-caracteristicas-especificas-group');
    Array.from(faqs).forEach(faq => {
        const listItems = faq.querySelector('.mi-caracteristicas-especificas-group-list');
        const items = faq.querySelectorAll('.list-group-item');
        const addItemBtn = faq.querySelector('.mi-group-new-item-btn');

        if (typeof items === undefined || !items || items.length <= 0) {
            console.error('Não foi encontrado nenhum item da lista de perguntas e respostas (FAQ).');
            return;
        }
        if (typeof listItems === undefined || !listItems) {
            console.error('Não foi encontrado a lista de itens de perguntas e respostas (FAQ).');
            return;
        }
        if (typeof addItemBtn === undefined || !addItemBtn) {
            console.error('Não foi encontrado o botão para adicionar novos itens na lista de perguntas e respostas (FAQ).');
            return;
        }

        miAddNewFaqItemEvent(addItemBtn, faq);
        miAddRemoveFaqItemEvent(faq);
    });
}

function miRecalcFaqItems(faq) {
    const faqList = faq.querySelector('.mi-caracteristicas-especificas-group-list');
    const items = faq.querySelectorAll('.list-group-item');

    if (typeof items === undefined || !items || items.length <= 0) {
        console.error('Não foi encontrado nenhum item da lista de perguntas e respostas (FAQ).');
        return;
    }
    if (typeof faqList === undefined || !faqList) {
        console.error('Não foi encontrado a lista de itens de perguntas e respostas (FAQ).');
        return;
    }


    Array.from(items).forEach((item, i) => {
        item.dataset.faqGroupItemId = i;
        const perguntaId = `imovel_caracteristicas-pergunta-${i}`;
        const respostaId = `imovel_caracteristicas-resposta-${i}`;
        const labels = item.querySelectorAll('label');
        const inputs = item.querySelectorAll('input');
        labels.forEach((label, i) => {
            if (i === 0) {
                label.setAttribute('for', perguntaId);
            } else {
                label.setAttribute('for', respostaId);
            }
        });
        inputs.forEach((input, i) => {
            if (i === 0) {
                input.id = perguntaId;
            }
        });
        // console.log('i', i);
    });
    // console.log('items.length', items.length);
    return items.length;
}

function miAddNewFaqItemEvent(addItemBtn, faq) {
    const listItems = faq.querySelector('.mi-caracteristicas-especificas-group-list');

    if (typeof listItems === undefined || !listItems) {
        console.error('Não foi encontrado a lista de itens de perguntas e respostas (FAQ).');
        return;
    }

    addItemBtn.addEventListener('click', miAddNewFaqItem.bind(null, listItems, faq));
}

function miAddNewFaqItem(listItems, faq, e) {
    e.preventDefault();

    // Item da lista
    const listItem = document.createElement('li');
    listItem.classList.add('mi-caracteristicas-especificas-group-item');
    listItem.classList.add('list-group-item');
    listItem.id = 'mi-caracteristicas-especificas-group-item-';
    listItem.dataset.faqGroupItemId = '';

    // Pergunta label
    const perguntaLabel = document.createElement('label');
    perguntaLabel.setAttribute('for', 'imovel_caracteristicas-especificas-');
    perguntaLabel.classList.add('form-label');
    perguntaLabel.innerText = 'Característica';

    listItem.append(perguntaLabel);

    // Pergunta input
    const perguntaInput = document.createElement('input');
    perguntaInput.setAttribute('type', 'text');
    perguntaInput.classList.add('form-control');
    perguntaInput.id = 'imovel_caracteristicas-especificas-';
    perguntaInput.name = 'imovel_caracteristicas-especificas[]';
    // perguntaInput.setAttribute('required', '');

    listItem.append(perguntaInput);

    // Div com mensagem de validação
    const divInvalidFeedback = document.createElement('div');
    divInvalidFeedback.classList.add('invalid-feedback');
    divInvalidFeedback.innerText = 'Campo obrigatório';

    listItem.append(divInvalidFeedback);

    // Div de container do botão de exclusão do item
    const divBtnWrapper = document.createElement('div');
    divBtnWrapper.classList.add('d-flex');

    // Botão de exclusão do item
    const btnRemoveItem = document.createElement('a');
    btnRemoveItem.classList.add('mi-delete-caracteristicas-especificas-group');
    btnRemoveItem.classList.add('btn');
    btnRemoveItem.classList.add('btn-danger');
    btnRemoveItem.classList.add('btn-sm');
    btnRemoveItem.classList.add('mt-2');
    btnRemoveItem.classList.add('ms-auto');
    btnRemoveItem.innerHTML = '<i class="bi bi-x-circle-fill"></i> Remover item';
    // btnRemoveItem.addEventListener('click', miRemoveFaqItem);

    divBtnWrapper.append(btnRemoveItem);

    listItem.append(divBtnWrapper);
    listItems.append(listItem);
    miAddRemoveFaqItemEvent(faq);
    miRecalcFaqItems(faq);
}

function miAddRemoveFaqItemEvent(faq) {
    const removeBtns = document.querySelectorAll('.mi-delete-caracteristicas-especificas-group');
    Array.from(removeBtns).forEach(removeBtn => {
        removeBtn.removeEventListener('click', miRemoveFaqItem);
        removeBtn.addEventListener('click', miRemoveFaqItem.bind(null, faq));
    });
}

function miRemoveFaqItem(faq, e) {
    e.preventDefault();
    const itemsLength = miRecalcFaqItems(faq);

    const item = e.target.closest('.mi-caracteristicas-especificas-group-item');
    if (itemsLength > 1) {
        item.remove();
    } else {
        const input = item.querySelector('input');
        if (typeof input !== undefined || !input) {
            input.value = '';
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    miFormsValidation();
    miPasswordStrength();
    miInitToasts();
    inputMasks();
    miGoBackBtn();
    miLimitFileUploadSize();
    miTooltips();
    miFileImagePreview();
    miClearInputValue();
    mi_contact_form();
    miSortTableList();
    miFaq();
});

function miNormalizeText(input) {
    // Converte o texto para minúsculas
    let lowerCaseText = input.toLowerCase();

    // Define um objeto de substituição para caracteres latinos
    const replacements = {
        'á': 'a', 'à': 'a', 'ã': 'a', 'â': 'a', 'ä': 'a',
        'é': 'e', 'è': 'e', 'ê': 'e', 'ë': 'e',
        'í': 'i', 'ì': 'i', 'î': 'i', 'ï': 'i',
        'ó': 'o', 'ò': 'o', 'õ': 'o', 'ô': 'o', 'ö': 'o',
        'ú': 'u', 'ù': 'u', 'û': 'u', 'ü': 'u',
        'ç': 'c', 'ñ': 'n',
        // Adicione mais substituições conforme necessário
    };

    // Substitui os caracteres latinos usando uma expressão regular
    lowerCaseText = lowerCaseText.replace(/[áàãâäéèêëíìîïóòõôöúùûüçñ]/g, match => replacements[match]);

    // Substitui espaços por hífens
    lowerCaseText = lowerCaseText.replace(/\s+/g, '-');

    return lowerCaseText;
}

function miInitAutocomplete() {
    const autocompleteWrappers = document.querySelectorAll('.autocomplete-wrapper');
    // if (typeof autocompleteInput === undefined || !autocompleteInput) {
    //     return;
    // }
    autocompleteWrappers.forEach(autocompleteWrapper => {
        const autocompleteInput = autocompleteWrapper.querySelector('.autocomplete');
        if (typeof autocompleteInput !== undefined && autocompleteInput) {
            autocomplete = new google.maps.places.Autocomplete(
                autocompleteInput,
                {
                    componentRestrictions: { 'country': ['PT'] },
                    fields: ['place_id', 'geometry', 'name', 'address_components']
                }
            );
            const autocompleteMessage = autocompleteWrapper.querySelector('.autocomplete-message');
            autocompleteInput.addEventListener('change', e => {
            });

            autocomplete.addListener('place_changed', () => miOnPlaceChanged(autocompleteMessage));
        }
    });
}

function miOnPlaceChanged(autocompleteMessage) {

    let place = autocomplete.getPlace();
    console.log('place', place);

    const miAutocompleteForm = autocompleteMessage.closest('form');

    if (typeof miAutocompleteForm === undefined || !miAutocompleteForm) {
        console.error('Não foi possível encontrar o formulário do autocomplete');
        return;
    }

    const latInput = miAutocompleteForm.querySelector('input[name="lat"]');
    const lngInput = miAutocompleteForm.querySelector('input[name="lng"]');
    const stateInput = miAutocompleteForm.querySelector('input[name="imovel_estado"]');
    const cidadeInput = miAutocompleteForm.querySelector('input[name="imovel_cidade"]');
    const cepInput = miAutocompleteForm.querySelector('input[name="imovel_codigo_postal"]');
    const imovelRua = miAutocompleteForm.querySelector('input[name="imovel_rua"]');
    const autocompleteFormBtn = document.getElementById('new-imovel-form-btn');
    let regiaoTerms = '';

    if (typeof autocompleteFormBtn !== undefined && autocompleteFormBtn) {
        autocompleteFormBtn.setAttribute('disabled', '');
    }

    if (typeof autocompleteMessage !== undefined && autocompleteMessage) {
        autocompleteMessage.style.display = 'block';
    }

    if (typeof latInput === undefined || !latInput) {
        console.error('Não foi possível encontrar o input de latitude');
        return;
    }

    if (typeof lngInput === undefined || !lngInput) {
        console.error('Não foi possível encontrar o input de longitude');
        return;
    }

    if (!place.geometry) {
        document.getElementById('autocomplete').placeholder = 'Digite um endereço';
        latInput.value = '';
        lngInput.value = '';
        if (typeof stateInput !== undefined && tateInput) {
            stateInput.value = '';
        }
        if (typeof cidadeInput !== undefined && cidadeInput) {
            cidadeInput.value = '';
        }
        if (typeof cepInput !== undefined && cepInput) {
            cepInput.value = '';
        }
        if (typeof imovelRua !== undefined && imovelRua) {
            imovelRua.value = '';
        }
        autocompleteMessage.style.display = 'block';
        if (typeof autocompleteFormBtn !== undefined && autocompleteFormBtn) {
            autocompleteFormBtn.setAttribute('disabled', '');
        }
        const regiaoTable = document.getElementById('table-regiao-imoveis');
        if (typeof regiaoTable !== undefined && regiaoTable) {
            const searchInput = regiaoTable.querySelector('[type="search"');
            if (typeof searchInput !== undefined && searchInput) {
                regiaoTerms = document.querySelectorAll('[name="regiao-terms[]"]');
                regiaoTerms.forEach(item => {
                    item.checked = false;
                    item.dispatchEvent(new Event('change'));
                });
                searchInput.value = '';
                searchInput.dispatchEvent(new Event('keyup'));
            }
        }
    } else {
        lat = place.geometry.location.lat();
        lng = place.geometry.location.lng();
        // console.log('lat', lat);
        // console.log('lng', lng);
        const estado = place.address_components.filter(item => item.types.includes('administrative_area_level_1'));
        const cidade = place.address_components.filter(item => item.types.includes('administrative_area_level_2'));
        const cep = place.address_components.filter(item => item.types.includes('postal_code'));
        const rua = place.address_components.filter(item => item.types.includes('route'));
        // console.log('estado', estado[0].short_name);
        // console.log('cidade', cidade[0].short_name);
        document.getElementById('autocomplete').innerHTML = place.name;
        latInput.value = lat;
        lngInput.value = lng;
        if (typeof stateInput !== undefined && stateInput) {
            stateInput.value = estado[0]?.short_name ? estado[0]?.short_name : '';
        }
        if (typeof cidadeInput !== undefined && cidadeInput) {
            cidadeInput.value = cidade[0]?.short_name ? cidade[0]?.short_name : '';
        }
        if (typeof cepInput !== undefined && cepInput) {
            cepInput.value = cep[0]?.short_name ? cep[0]?.short_name : '';
        }

        if (typeof imovelRua !== undefined && imovelRua) {
            imovelRua.value = rua[0]?.long_name ? rua[0]?.long_name : '';
        }

        const regiaoTable = document.getElementById('table-regiao-imoveis');
        if (typeof regiaoTable !== undefined && regiaoTable) {
            const searchInput = regiaoTable.querySelector('[type="search"');
            if (typeof searchInput !== undefined && searchInput) {
                searchInput.value = estado[0]?.short_name;
                searchInput.dispatchEvent(new Event('keyup'));

                const normalizeEstado = miNormalizeText(estado[0]?.short_name);

                regiaoTerms = document.querySelectorAll('[name="regiao-terms[]"]');
                regiaoTerms.forEach(item => {
                    const normalizeitemName = miNormalizeText(item.getAttribute('data-name'));
                    if (normalizeEstado === normalizeitemName) {
                        item.checked = true;
                        item.dispatchEvent(new Event('change'));
                    }
                });
            }
        }


        autocompleteMessage.style.display = 'none';
        if (typeof autocompleteFormBtn !== undefined && autocompleteFormBtn) {
            autocompleteFormBtn.removeAttribute('disabled');
        }
    }
}

function initGoogleApi() {
    window.addEventListener('load', function () {
        initMap();
        miInitAutocomplete();
    });
}

initGoogleApi();
