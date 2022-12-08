import { setupWalletSelector } from '@near-wallet-selector/core';
import { setupHereWallet } from '@here-wallet/near-selector';
import { setupMyNearWallet } from '@near-wallet-selector/my-near-wallet';

import { setupModal } from '@near-wallet-selector/modal-ui';
import { setupNearWallet } from '@near-wallet-selector/near-wallet';
import { map } from 'rxjs';

import '@near-wallet-selector/modal-ui-js/styles.css';

const signInClass = '.login-with-near-link';
const signOutClass = '.logout-with-near-link';

const selector = await setupWalletSelector({
  contractId: '',
  network: window.near_login.network,
  modules: [
    setupNearWallet(),
    setupMyNearWallet(),
    setupHereWallet()
  ],
});


window.state = selector.store.getState();

if (selector.isSignedIn()) {
  window.wallet = await selector.wallet();
  const [account] =  await window.wallet.getAccounts();
  if (account) {
    window.userAccount = account.accountId;
  }
}

const signInWithNear = (accId) => {
  const {ajaxUrl} = window.near_login;
  jQuery.ajax({
    type: 'POST',
    url: ajaxUrl,
    data: {
      action: 'loginWithNearLogin',
      account: accId,
    },
    success: (result) => {
      if (result.errorMessage) {
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

const subscription = selector.store.observable
  .pipe(
    map((state) => state.accounts),
  )
  .subscribe((nextAccounts) => {
    if (nextAccounts.length > 0 && !window?.near_login?.user) {
      const [account] = nextAccounts;
      signInWithNear(account.accountId);
    }
  });
const logOutAction = async (event) => {
  const wallet = await selector.wallet();
  if (wallet) {
    await wallet.signOut();
  }
}

document.addEventListener('DOMContentLoaded', async () => {
  const options = {};
  if (window.near_login.account_id) {
    options.contractId = window.near_login.account_id;
  }
  const modal = await setupModal(selector, options);
  jQuery(signInClass).click(() => {
    modal.show();
  });
  jQuery(signOutClass).click(async (event) => {
    await logOutAction(event);
  });
});
