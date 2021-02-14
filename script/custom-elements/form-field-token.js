class FormFieldToken extends HTMLElement {
    constructor() {
        super();
        //attach shadow DOM
        this.attachShadow({ mode: 'open' })

        //bind
        this._manageToken = this._manageToken.bind(this)

        //init values
        this.tokens = []
        this.stringifyTokens = ""
        this._generateFormFields()
    }


    /**
     * generate component
     *
     * @private
     */
    _generateFormFields() {

        if(this.shadowRoot.innerHTML) {
            return
        }

        const data = this.getAttribute("data")


        //generate container

        this.container = document.createElement("div")
        this.container.classList.add('container')
        this.container.innerHTML = `
            <div class="wrapper"></div>
            <input type="text" placeholder="${this.getAttribute('placeholder')}" class="input"/>
        `

        //generate data storage in the shape of input

        this.inputStorage = document.createElement('input')
        this.inputStorage.type = 'hidden'
        this.inputStorage.name = this.getAttribute('name')
        this.inputStorage.id = "input-hidden"
        this.inputStorage.value = data ? data : "[]"
        this.parentNode.appendChild(this.inputStorage)

        //add input event

        this.input = this.container.querySelector('.input')
        this.input.addEventListener('input',this._manageToken)

        //get wrapper ref

        this.wrapper = this.container.querySelector(".wrapper")
        if(data.length > 0) {

            this.tokens = JSON.parse(data)

            this._createInitialTokens(this.tokens)
            this._saveTokens()
        }

        //append component in shadowRoot

        this.shadowRoot.appendChild(this.container)

        //apply style on input

        this._applyStyle()
    }

    /**
     *
     * apply style to elements
     *
     * @private
     */
    _applyStyle() {
        this.styleElement = document.createElement("style")
        this.styleElement.innerHTML = `
        .container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }
        .wrapper {
            display:flex;
            flex-wrap: wrap;
            padding: 10px 0;
        }
        .input{
            padding: 5px;
            font-size: 1.1em;
            width: 100%;
        }
        .fields {
            cursor: pointer;
            margin: 0 5px 5px 0;
            padding: 8px 12px;
            border-radius: 15px;
            border: none;
            background-color: #0073aa;
            color: white;
        }
        .fields:focus {
            outline: none;
        }
        `
        this.shadowRoot.appendChild(this.styleElement)
    }

    /**
     *
     * manage tokens on input
     *
     * @param {InputEvent} e
     * @private
     */
    _manageToken(e) {
        const value = e.target.value
        const tokens = value.split(";")

        if(tokens.length > 1 ) {
            e.target.value = tokens[1]
            this.tokens.push(tokens[0])
            this.wrapper.appendChild(this._createToken(tokens[0]))
            this._saveTokens()

        }
    }

    /**
     *
     * @param {string[]} tokens
     * @private
     */
    _createInitialTokens(tokens) {
        const tokenElements = tokens.map(token => this._createToken(token))
        tokenElements.forEach(element => this.wrapper.appendChild(element))
    }

    /**
     *
     * create token and its corresponding element
     *
     * @param {string} value
     * @private
     */
    _createToken(value) {
        const tokenElement = document.createElement('button')
        tokenElement.innerText = value
        tokenElement.classList.add('fields')
        tokenElement.setAttribute("title", "Click to delete")
        tokenElement.addEventListener('click', (e) => this._removeToken(e))
        return tokenElement
    }

    /**
     *
     * remove the token and its corresponding element
     *
     * @param {MouseEvent} e
     * @private
     */
    _removeToken(e) {
        let deletedToken = ""
        const value = e.target.innerText
        e.target.parentNode.removeChild(e.target)
        this.tokens = this.tokens.filter(item => {
            if(!deletedToken && item === value) {
                deletedToken = item
                return false
            }
            return true
        })
        this._saveTokens()
    }


    /**
     *
     * save the tokens in input data storage
     *
     * @private
     */
    _saveTokens () {
        this.stringifyTokens = JSON.stringify(this.tokens)
        this.inputStorage.value = this.stringifyTokens
    }
}

customElements.define('form-field-token', FormFieldToken)
