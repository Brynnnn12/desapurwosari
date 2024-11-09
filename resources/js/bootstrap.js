import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// {
//     "version": 3,
//     "file": "chunk-HKJ2B2AA.js",
//     "sources": ["source1.js", "source2.js"],
//     "sourcesContent": ["// content of source1", "// content of source2"],
//     "mappings": "AAAA,SAAS,CAAC,CAAC;..."
//   }
