import { renderProducts } from './renderProducts';
import { productGrid } from './productGrid';
import { renderShop } from './shop';
import { renderMenu} from './menu';

export let renderComponents = () => {

    // renderFaqs();
    // renderForm();
    renderProducts();
    productGrid();
    renderShop();
    renderMenu();
}

renderComponents();