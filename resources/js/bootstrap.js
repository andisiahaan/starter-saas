import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Trix Rich Text Editor
import 'trix';
import 'trix/dist/trix.css';
