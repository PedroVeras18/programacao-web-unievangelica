import { CreateCarUseCase } from '../create-car-use-case'
import { PrismaCarsRepository } from '@/repositories/prisma/prisma-cars-repository'
import { DeleteCarUseCase } from '../delete-car-use-case'
import { GetAllCarsUseCase } from '../get-all-cars-use-case'
import { GetByIdCarUseCase } from '../get-by-id-car-use-case'
import { UpdateCarUseCase } from '../update-car-use-case'

const carsRepository = new PrismaCarsRepository()

export function MakeCreateCarUseCase() {
  const createCarUseCase = new CreateCarUseCase(carsRepository)

  return createCarUseCase
}

export function MakeGetAllCarsUseCase() {
  const getAllCarsUseCase = new GetAllCarsUseCase(carsRepository)

  return getAllCarsUseCase
}

export function MakeGetByIdCarsUseCase() {
  const getByIdCarUseCase = new GetByIdCarUseCase(carsRepository)

  return getByIdCarUseCase
}

export function MakeUpdateCarUseCase() {
  const updateCarUseCase = new UpdateCarUseCase(carsRepository)

  return updateCarUseCase
}

export function MakeDeleteCarUseCase() {
  const deleteCarUseCase = new DeleteCarUseCase(carsRepository)

  return deleteCarUseCase
}
