class FormFieldToken extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: 'open' })
        console.log(this.getAttribute('name'))
        this.shadowRoot.innerHTML = `
            <input type="text" name="${this.getAttribute('name')}" placeholder="${this.getAttribute('placeholder')}"/>
        `

        this.addEventListener('input', () => {
            console.log("e")
        })
    }
}

customElements.define('form-field-token', FormFieldToken)
