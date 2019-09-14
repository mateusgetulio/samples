import { GET_ERRORS, CLEAR_ERRORS } from '../actions/types';

// Initialize the state
const initialState = {};

// Handle the errors
export default function(state = initialState, action) {
  switch (action.type) {
    case GET_ERRORS:
      return action.payload;
    case CLEAR_ERRORS:
      return {};
    default:
      return state;
  }
}
