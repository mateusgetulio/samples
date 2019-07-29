class Familia < ApplicationRecord
  self.table_name = "familias"
  has_many :pets
  
end