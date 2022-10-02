function addParametro() {
    nparam++

    const par = document.createElement('div')
    par.id = 'parametro' + nparam

    const r1 = document.createElement('div')
    r1.className = "row ms-4 mb-2 mt-3"
    r1.innerText = "Parametro " + nparam + ":"
    par.appendChild(r1)

    const r2 = document.createElement('div')
    r2.className = "row mb-2"
    const c11 = document.createElement('div')
    c11.className = "col-4"
    const nome = document.createElement('input')
    nome.setAttribute('type','test')
    nome.setAttribute('class','form-control')
    nome.setAttribute('id',nparam + 'nome')
    nome.setAttribute('name',nparam + 'nome')
    nome.setAttribute('placeholder','Nome')
    nome.setAttribute('required','')
    c11.appendChild(nome)
    const inf = document.createElement('div')
    inf.className = "invalid-feedback"
    inf.innerText = 'Campo richiesto!'
    c11.appendChild(inf)
    r2.appendChild(c11)
    const c12 = document.createElement('div')
    c12.className = "col-5"
    const descrizione = document.createElement('input')
    descrizione.setAttribute('type','test')
    descrizione.setAttribute('class','form-control')
    descrizione.setAttribute('id',nparam + 'descrizione')
    descrizione.setAttribute('name',nparam + 'descrizione')
    descrizione.setAttribute('placeholder','Descrizione')
    c12.appendChild(descrizione)
    r2.appendChild(c12)
    const c13 = document.createElement('div')
    c13.className = "col-2"
    const tipoParametro = document.createElement('select')
    tipoParametro.setAttribute('class','form-select')
    tipoParametro.setAttribute('id',nparam + 'tipoParametro')
    tipoParametro.setAttribute('name',nparam + 'tipoParametro')
    tipoParametro.setAttribute('required','')
    const op1 = document.createElement('option')
    op1.value = ''
    op1.text = 'Tipo Parametro...'
    const op2 = document.createElement('option')
    op2.value = '0'
    op2.text = 'Obbligatorio'
    const op3 = document.createElement('option')
    op3.value = '1'
    op3.text = 'Facoltativo default ON'
    const op4 = document.createElement('option')
    op4.value = '2'
    op4.text = 'Facoltativo default OFF'
    const op5 = document.createElement('option')
    op5.value = '3'
    op5.text = 'Nascosto'
    tipoParametro.appendChild(op1)
    tipoParametro.appendChild(op2)
    tipoParametro.appendChild(op3)
    tipoParametro.appendChild(op4)
    tipoParametro.appendChild(op5)
    c13.appendChild(tipoParametro)
    const inf2 = document.createElement('div')
    inf2.className = "invalid-feedback"
    inf2.innerText = 'Campo richiesto!'
    c13.appendChild(inf2)
    r2.appendChild(c13)

    par.appendChild(r2)

    const r3 = document.createElement('div')
    r3.className = "row mb-2"
    const c21 = document.createElement('div')
    c21.className = "col-3"
    const pre = document.createElement('input')
    pre.setAttribute('type','text')
    pre.setAttribute('class','form-control')
    pre.setAttribute('id',nparam + 'pre')
    pre.setAttribute('name',nparam + 'pre')
    pre.setAttribute('placeholder','Pre')
    c21.appendChild(pre)
    r3.appendChild(c21)
    const c22 = document.createElement('div')
    c22.className = "col-3"
    const valore = document.createElement('input')
    valore.setAttribute('type','text')
    valore.setAttribute('class','form-control')
    valore.setAttribute('id',nparam + 'valore')
    valore.setAttribute('name',nparam + 'valore')
    valore.setAttribute('placeholder','Valore')
    c22.appendChild(valore)
    r3.appendChild(c22)
    const c23 = document.createElement('div')
    c23.className = "col-3"
    const post = document.createElement('input')
    post.setAttribute('type','text')
    post.setAttribute('class','form-control')
    post.setAttribute('id',nparam + 'post')
    post.setAttribute('name',nparam + 'post')
    post.setAttribute('placeholder','Post')
    c23.appendChild(post)
    r3.appendChild(c23)
    const c24 = document.createElement('div')
    c24.className = "col-2"
    const tipoValore = document.createElement('select')
    tipoValore.setAttribute('class','form-select')
    tipoValore.setAttribute('id',nparam + 'tipoVlore')
    tipoValore.setAttribute('name',nparam + 'tipoValore')
    tipoValore.setAttribute('required','')
    const op21 = document.createElement('option')
    op21.value = ''
    op21.text = 'Tipo Valore...'
    const op22 = document.createElement('option')
    op22.value = '0'
    op22.text = 'Nessun valore'
    const op23 = document.createElement('option')
    op23.value = '1'
    op23.text = 'Stringa (anche vuota)'
    const op24 = document.createElement('option')
    op24.value = '2'
    op24.text = 'Stringa (NON vuota)'
    tipoValore.appendChild(op21)
    tipoValore.appendChild(op22)
    tipoValore.appendChild(op23)
    tipoValore.appendChild(op24)
    c24.appendChild(tipoValore)
    const inf3 = document.createElement('div')
    inf3.className = "invalid-feedback"
    inf3.innerText = 'Campo richiesto!'
    c24.appendChild(inf3)
    r3.appendChild(c24)
    const c25 = document.createElement('div')
    c25.className = "col-1 d-flex align-items-center"
    c25.innerHTML = '<a href="#" onClick="document.getElementById(\'parametro' + nparam+ '\').remove();return false"><img src="/RunMe/Assets/img/trash.svg"> </a>'
    r3.appendChild(c25)

    par.appendChild(r3)


    document.getElementById('parametri').appendChild(par)


}
