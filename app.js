import {map} from 'rxjs';

import '@near-wallet-selector/modal-ui-js/styles.css';

const signInClass = '.login-with-near-link';
const signOutClass = '.logout-with-near-link';
import { Wallet } from './near-wallet';


const wallet = new Wallet({
        createAccessKeyFor: window.near_login.contract_id || '',
        network: 'mainnet'
    }
);
await wallet.startUp();

window.mainWallet = wallet;

window.state =  wallet.walletSelector.store.getState();


const signInWithNear = (accId) => {
    const {ajaxUrl} = window.near_login;
    jQuery.ajax({
        type: 'POST',
        url: ajaxUrl,
        data: {
            action: 'loginWithNearLogin',
            account: accId,
        },
        success: async (result) => {
            if (result.errorMessage) {
                if (result.errorMessage === 'Please use named .near account') {
                    deleteAllCookies();
                    window.localStorage.clear();
                }
                alert(result.errorMessage);
            } else {
                location.reload();
            }
        },
        error: (error) => {
            console.log(error);
        },
    });
}

const logOutAction = async (event) => {
    console.log('logout');
    const {ajaxUrl} = window.near_login;
    //event.preventDefault();
    localStorage.setItem(`logged_in`, null);
    deleteAllCookies();
    window.localStorage.clear();
    jQuery.ajax({
        type: 'POST',
        url: ajaxUrl,
        data: {
            action: 'logoutWithNear',
        },
        success: async (result) => {
            window.location.reload();
        },
        error: (error) => {
            console.log(error);
        },
    });
}

window.logOutAction = logOutAction;

const deleteAllCookies = () => {
    const cookies = document.cookie.split(";");

    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i];
        const eqPos = cookie.indexOf("=");
        const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

const subscription = window.mainWallet.walletSelector.store.observable
    .pipe(
        map((state) => state.accounts),
    )
    .subscribe((nextAccounts) => {
        if (nextAccounts.length > 0 && !window?.near_login?.user) {
            const [account] = nextAccounts;
            signInWithNear(account.accountId);
        }
    });


jQuery(signInClass).click(async (event) => {
    event.preventDefault();
    await wallet.signIn();
});
// jQuery(signOutClass).click(async (event) => {
//     event.preventDefault();
//     await logOutAction(event);
// });





