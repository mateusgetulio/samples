import {
  GET_HISTORY,
  GET_HISTORY_BY_MONTH,
  GET_HISTORY_BY_YEAR
} from "../actions/types";

// Initialize the state
const initialState = {
  history: null
};

// Handle the history data request
export default function(state = initialState, action) {
  switch (action.type) {
    case GET_HISTORY:
      return {
        ...state,
        history: action.payload
      };
    case GET_HISTORY_BY_MONTH:
      return {
        ...state,
        history: action.payload
      };
    case GET_HISTORY_BY_YEAR:
      return {
        ...state,
        history: action.payload
      };
    default:
      return state;
  }
}
