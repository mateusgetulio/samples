import isEmpty from '../validation/is-empty';
import { SET_CURRENT_USER } from '../actions/types';

// Initialize the state
const initialState = {
  isAuthenticated: false,
  user: {}
};

// Set the current user
export default function(state = initialState, action) {
  switch (action.type) {
    case SET_CURRENT_USER:
      return {
        ...state,
        isAuthenticated: !isEmpty(action.payload),
        user: action.payload
      };
    default:
      return state;
  }
}
